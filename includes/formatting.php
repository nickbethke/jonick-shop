<?php

function map_deep($value, $callback)
{
    if (is_array($value)) {
        foreach ($value as $index => $item) {
            $value[$index] = map_deep($item, $callback);
        }
    } elseif (is_object($value)) {
        $object_vars = get_object_vars($value);
        foreach ($object_vars as $property_name => $property_value) {
            $value->$property_name = map_deep($property_value, $callback);
        }
    } else {
        $value = call_user_func($callback, $value);
    }

    return $value;
}

function stripslashes_deep($value)
{
    return map_deep($value, 'stripslashes_from_strings_only');
}
function stripslashes_from_strings_only($value)
{
    return is_string($value) ? stripslashes($value) : $value;
}

function unslash($value)
{
    return stripslashes_deep($value);
}

function check_invalid_utf8($string, $strip = false)
{
    $string = (string) $string;

    if (0 === strlen($string)) {
        return '';
    }

    // Store the site charset as a static to avoid multiple calls to get_option().
    static $is_utf8 = null;
    if (!isset($is_utf8)) {
        $is_utf8 = 'utf8';
    }
    if (!$is_utf8) {
        return $string;
    }

    // Check for support for utf8 in the installed PCRE library once and store the result in a static.
    static $utf8_pcre = null;
    if (!isset($utf8_pcre)) {
        // phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged
        $utf8_pcre = @preg_match('/^./u', 'a');
    }
    // We can't demand utf8 in the PCRE installation, so just return the string in those cases.
    if (!$utf8_pcre) {
        return $string;
    }

    // phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged -- preg_match fails when it encounters invalid UTF8 in $string.
    if (1 === @preg_match('/^./us', $string)) {
        return $string;
    }

    // Attempt to strip the bad chars if requested (not recommended).
    if ($strip && function_exists('iconv')) {
        return iconv('utf-8', 'utf-8', $string);
    }

    return '';
}

function _specialchars($string, $quote_style = ENT_NOQUOTES, $charset = false, $double_encode = false)
{
    $string = (string) $string;

    if (0 === strlen($string)) {
        return '';
    }

    // Don't bother if there are no specialchars - saves some processing.
    if (!preg_match('/[&<>"\']/', $string)) {
        return $string;
    }

    // Account for the previous behaviour of the function when the $quote_style is not an accepted value.
    if (empty($quote_style)) {
        $quote_style = ENT_NOQUOTES;
    } elseif (ENT_XML1 === $quote_style) {
        $quote_style = ENT_QUOTES | ENT_XML1;
    } elseif (!in_array($quote_style, array(ENT_NOQUOTES, ENT_COMPAT, ENT_QUOTES, 'single', 'double'), true)) {
        $quote_style = ENT_QUOTES;
    }

    $charset = 'UTF-8';


    $_quote_style = $quote_style;

    if ('double' === $quote_style) {
        $quote_style  = ENT_COMPAT;
        $_quote_style = ENT_COMPAT;
    } elseif ('single' === $quote_style) {
        $quote_style = ENT_NOQUOTES;
    }

    $string = htmlspecialchars($string, $quote_style, $charset, $double_encode);

    // Back-compat.
    if ('single' === $_quote_style) {
        $string = str_replace("'", '&#039;', $string);
    }

    return $string;
}

function esc_attr($text)
{
    $safe_text = check_invalid_utf8($text);
    return _specialchars($safe_text, ENT_QUOTES);
}
function urlencode_deep($value)
{
    return map_deep($value, 'urlencode');
}
function _deep_replace($search, $subject)
{
    $subject = (string) $subject;

    $count = 1;
    while ($count) {
        $subject = str_replace($search, '', $subject, $count);
    }

    return $subject;
}
function esc_url($url, $protocols = null, $_context = 'display')
{
    $original_url = $url;

    if ('' === $url) {
        return $url;
    }

    $url = str_replace(' ', '%20', ltrim($url));
    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\[\]\\x80-\\xff]|i', '', $url);

    if ('' === $url) {
        return $url;
    }

    if (0 !== stripos($url, 'mailto:')) {
        $strip = array('%0d', '%0a', '%0D', '%0A');
        $url   = _deep_replace($strip, $url);
    }

    $url = str_replace(';//', '://', $url);

    if (
        strpos($url, ':') === false && !in_array($url[0], array('/', '#', '?'), true) &&
        !preg_match('/^[a-z0-9-]+?\.php/i', $url)
    ) {
        $url = 'http://' . $url;
    }

    // Replace ampersands and single quotes only when displaying.
    if ('display' === $_context) {
        $url = str_replace('&amp;', '&#038;', $url);
        $url = str_replace("'", '&#039;', $url);
    }

    if ((false !== strpos($url, '[')) || (false !== strpos($url, ']'))) {

        $parsed = _parse_url($url);
        $front  = '';

        if (isset($parsed['scheme'])) {
            $front .= $parsed['scheme'] . '://';
        } elseif ('/' === $url[0]) {
            $front .= '//';
        }

        if (isset($parsed['user'])) {
            $front .= $parsed['user'];
        }

        if (isset($parsed['pass'])) {
            $front .= ':' . $parsed['pass'];
        }

        if (isset($parsed['user']) || isset($parsed['pass'])) {
            $front .= '@';
        }

        if (isset($parsed['host'])) {
            $front .= $parsed['host'];
        }

        if (isset($parsed['port'])) {
            $front .= ':' . $parsed['port'];
        }

        $end_dirty = str_replace($front, '', $url);
        $end_clean = str_replace(array('[', ']'), array('%5B', '%5D'), $end_dirty);
        $url       = str_replace($end_dirty, $end_clean, $url);
    }

    if ('/' === $url[0]) {
        $good_protocol_url = $url;
    } else {
        if (!is_array($protocols)) {
            $protocols = wp_allowed_protocols();
        }
    }
    return $url;
}
