<?php

class Scripts extends Dependencies
{
    /**
     * Base URL for scripts.
     *
     * Full URL with trailing slash.
     *
     * @since 2.6.0
     * @var string
     */
    public $base_url;

    /**
     * URL of the content directory.
     *
     * @since 2.8.0
     * @var string
     */
    public $content_url;

    /**
     * Default version string for scripts.
     *
     * @since 2.6.0
     * @var string
     */
    public $default_version;

    /**
     * Holds handles of scripts which are enqueued in footer.
     *
     * @since 2.8.0
     * @var array
     */
    public $in_footer = array();

    /**
     * Holds a list of script handles which will be concatenated.
     *
     * @since 2.8.0
     * @var string
     */
    public $concat = '';

    /**
     * Holds a string which contains script handles and their version.
     *
     * @since 2.8.0
     * @deprecated 3.4.0
     * @var string
     */
    public $concat_version = '';

    /**
     * Whether to perform concatenation.
     *
     * @since 2.8.0
     * @var bool
     */
    public $do_concat = false;

    /**
     * Holds HTML markup of scripts and additional data if concatenation
     * is enabled.
     *
     * @since 2.8.0
     * @var string
     */
    public $print_html = '';

    /**
     * Holds inline code if concatenation is enabled.
     *
     * @since 2.8.0
     * @var string
     */
    public $print_code = '';

    /**
     * Holds a list of script handles which are not in the default directory
     * if concatenation is enabled.
     *
     * Unused in core.
     *
     * @since 2.8.0
     * @var string
     */
    public $ext_handles = '';

    /**
     * Holds a string which contains handles and versions of scripts which
     * are not in the default directory if concatenation is enabled.
     *
     * Unused in core.
     *
     * @since 2.8.0
     * @var string
     */
    public $ext_version = '';

    /**
     * List of default directories.
     *
     * @since 2.8.0
     * @var array
     */
    public $default_dirs;

    /**
     * Holds a string which contains the type attribute for script tag.
     *
     * If the current theme does not declare HTML5 support for 'script',
     * then it initializes as `type='text/javascript'`.
     *
     * @since 5.3.0
     * @var string
     */
    private $type_attr = '';

    /**
     * Constructor.
     *
     * @since 2.6.0
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * Initialize the class.
     *
     * @since 3.4.0
     */
    public function init()
    {
        $this->type_attr = " type='text/javascript'";
    }

    public function print_scripts($handles = false, $group = false)
    {
        return $this->do_items($handles, $group);
    }

    public function print_extra_script($handle, $echo = true)
    {
        $output = $this->get_data($handle, 'data');
        if (!$output) {
            return;
        }

        if (!$echo) {
            return $output;
        }

        printf("<script%s id='%s-js-extra'>\n", $this->type_attr, esc_attr($handle));

        // CDATA is not needed for HTML 5.
        if ($this->type_attr) {
            echo "/* <![CDATA[ */\n";
        }

        echo "$output\n";

        if ($this->type_attr) {
            echo "/* ]]> */\n";
        }

        echo "</script>\n";

        return true;
    }

    public function do_item($handle, $group = false)
    {
        if (!parent::do_item($handle)) {
            return false;
        }

        if (0 === $group && $this->groups[$handle] > 0) {
            $this->in_footer[] = $handle;
            return false;
        }

        if (false === $group && in_array($handle, $this->in_footer, true)) {
            $this->in_footer = array_diff($this->in_footer, (array) $handle);
        }

        $obj = $this->registered[$handle];

        if (null === $obj->ver) {
            $ver = '';
        } else {
            $ver = $obj->ver ? $obj->ver : $this->default_version;
        }

        if (isset($this->args[$handle])) {
            $ver = $ver ? $ver . '&amp;' . $this->args[$handle] : $this->args[$handle];
        }

        $src         = $obj->src;
        $cond_before = '';
        $cond_after  = '';
        $conditional = isset($obj->extra['conditional']) ? $obj->extra['conditional'] : '';

        if ($conditional) {
            $cond_before = "<!--[if {$conditional}]>\n";
            $cond_after  = "<![endif]-->\n";
        }

        $before_handle = $this->print_inline_script($handle, 'before', false);
        $after_handle  = $this->print_inline_script($handle, 'after', false);

        if ($before_handle) {
            $before_handle = sprintf("<script%s id='%s-js-before'>\n%s\n</script>\n", $this->type_attr, esc_attr($handle), $before_handle);
        }

        if ($after_handle) {
            $after_handle = sprintf("<script%s id='%s-js-after'>\n%s\n</script>\n", $this->type_attr, esc_attr($handle), $after_handle);
        }

        if ($before_handle || $after_handle) {
            $inline_script_tag = $cond_before . $before_handle . $after_handle . $cond_after;
        } else {
            $inline_script_tag = '';
        }

        $has_conditional_data = $conditional && $this->get_data($handle, 'data');

        if ($has_conditional_data) {
            echo $cond_before;
        }

        $this->print_extra_script($handle);

        if ($has_conditional_data) {
            echo $cond_after;
        }

        // A single item may alias a set of items, by having dependencies, but no source.
        if (!$src) {
            if ($inline_script_tag) {
                if ($this->do_concat) {
                    $this->print_html .= $inline_script_tag;
                } else {
                    echo $inline_script_tag;
                }
            }

            return true;
        }

        if (!preg_match('|^(https?:)?//|', $src) && !($this->content_url && 0 === strpos($src, $this->content_url))) {
            $src = $this->base_url . $src;
        }

        if (!empty($ver)) {
            $src = add_query_arg('ver', $ver, $src);
        }

        if (!$src) {
            return true;
        }

        $tag  = $cond_before . $before_handle;
        $tag .= sprintf("<script%s src='%s' id='%s-js'></script>\n", $this->type_attr, $src, esc_attr($handle));
        $tag .= $after_handle . $cond_after;

        if ($this->do_concat) {
            $this->print_html .= $tag;
        } else {
            echo $tag;
        }

        return true;
    }

    /**
     * Adds extra code to a registered script.
     *
     * @since 4.5.0
     *
     * @param string $handle   Name of the script to add the inline script to.
     *                         Must be lowercase.
     * @param string $data     String containing the JavaScript to be added.
     * @param string $position Optional. Whether to add the inline script
     *                         before the handle or after. Default 'after'.
     * @return bool True on success, false on failure.
     */
    public function add_inline_script($handle, $data, $position = 'after')
    {
        if (!$data) {
            return false;
        }

        if ('after' !== $position) {
            $position = 'before';
        }

        $script   = (array) $this->get_data($handle, $position);
        $script[] = $data;

        return $this->add_data($handle, $position, $script);
    }

    /**
     * Prints inline scripts registered for a specific handle.
     *
     * @since 4.5.0
     *
     * @param string $handle   Name of the script to add the inline script to.
     *                         Must be lowercase.
     * @param string $position Optional. Whether to add the inline script
     *                         before the handle or after. Default 'after'.
     * @param bool   $echo     Optional. Whether to echo the script
     *                         instead of just returning it. Default true.
     * @return string|false Script on success, false otherwise.
     */
    public function print_inline_script($handle, $position = 'after', $echo = true)
    {
        $output = $this->get_data($handle, $position);

        if (empty($output)) {
            return false;
        }

        $output = trim(implode("\n", $output), "\n");

        if ($echo) {
            printf("<script%s id='%s-js-%s'>\n%s\n</script>\n", $this->type_attr, esc_attr($handle), esc_attr($position), $output);
        }

        return $output;
    }


    /**
     * Sets handle group.
     *
     * @since 2.8.0
     *
     * @see WP_Dependencies::set_group()
     *
     * @param string    $handle    Name of the item. Should be unique.
     * @param bool      $recursion Internal flag that calling function was called recursively.
     * @param int|false $group     Optional. Group level: level (int), no groups (false).
     *                             Default false.
     * @return bool Not already in the group or a lower group.
     */
    public function set_group($handle, $recursion, $group = false)
    {
        if (isset($this->registered[$handle]->args) && 1 === $this->registered[$handle]->args) {
            $grp = 1;
        } else {
            $grp = (int) $this->get_data($handle, 'group');
        }

        if (false !== $group && $grp > $group) {
            $grp = $group;
        }

        return parent::set_group($handle, $recursion, $grp);
    }

    /**
     * Sets a translation textdomain.
     *
     * @since 5.0.0
     * @since 5.1.0 The `$domain` parameter was made optional.
     *
     * @param string $handle Name of the script to register a translation domain to.
     * @param string $domain Optional. Text domain. Default 'default'.
     * @param string $path   Optional. The full file path to the directory containing translation files.
     * @return bool True if the text domain was registered, false if not.
     */
    public function set_translations($handle, $domain = 'default', $path = null)
    {
        if (!isset($this->registered[$handle])) {
            return false;
        }

        /** @var \_WP_Dependency $obj */
        $obj = $this->registered[$handle];

        if (!in_array('wp-i18n', $obj->deps, true)) {
            $obj->deps[] = 'wp-i18n';
        }

        return $obj->set_translations($domain, $path);
    }

    /**
     * Determines script dependencies.
     *
     * @since 2.1.0
     *
     * @see WP_Dependencies::all_deps()
     *
     * @param string|string[] $handles   Item handle (string) or item handles (array of strings).
     * @param bool            $recursion Optional. Internal flag that function is calling itself.
     *                                   Default false.
     * @param int|false       $group     Optional. Group level: level (int), no groups (false).
     *                                   Default false.
     * @return bool True on success, false on failure.
     */
    public function all_deps($handles, $recursion = false, $group = false)
    {
        $r = parent::all_deps($handles, $recursion, $group);
        return $r;
    }

    /**
     * Processes items and dependencies for the head group.
     *
     * @since 2.8.0
     *
     * @see WP_Dependencies::do_items()
     *
     * @return string[] Handles of items that have been processed.
     */
    public function do_head_items()
    {
        $this->do_items(false, 0);
        return $this->done;
    }

    /**
     * Processes items and dependencies for the footer group.
     *
     * @since 2.8.0
     *
     * @see WP_Dependencies::do_items()
     *
     * @return string[] Handles of items that have been processed.
     */
    public function do_footer_items()
    {
        $this->do_items(false, 1);
        return $this->done;
    }

    /**
     * Whether a handle's source is in a default directory.
     *
     * @since 2.8.0
     *
     * @param string $src The source of the enqueued script.
     * @return bool True if found, false if not.
     */
    public function in_default_dir($src)
    {
        if (!$this->default_dirs) {
            return true;
        }

        if (0 === strpos($src, '/' . "include" . '/js/l10n')) {
            return false;
        }

        foreach ((array) $this->default_dirs as $test) {
            if (0 === strpos($src, $test)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Resets class properties.
     *
     * @since 2.8.0
     */
    public function reset()
    {
        $this->do_concat      = false;
        $this->print_code     = '';
        $this->concat         = '';
        $this->concat_version = '';
        $this->print_html     = '';
        $this->ext_version    = '';
        $this->ext_handles    = '';
    }
}
