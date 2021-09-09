<?php

function absint($maybeint)
{
    return abs((int) $maybeint);
}

function hash_password($password)
{

    require_once INC_PATH . 'classes/phpass.php';
    // By default, use the portable hash from phpass.
    $hasher = new PasswordHash(8, true);

    return $hasher->HashPassword(trim($password));
}

function add_query_arg(...$args)
{
    if (is_array($args[0])) {
        if (count($args) < 2 || false === $args[1]) {
            $uri = $_SERVER['REQUEST_URI'];
        } else {
            $uri = $args[1];
        }
    } else {
        if (count($args) < 3 || false === $args[2]) {
            $uri = $_SERVER['REQUEST_URI'];
        } else {
            $uri = $args[2];
        }
    }

    $frag = strstr($uri, '#');
    if ($frag) {
        $uri = substr($uri, 0, -strlen($frag));
    } else {
        $frag = '';
    }

    if (0 === stripos($uri, 'http://')) {
        $protocol = 'http://';
        $uri      = substr($uri, 7);
    } elseif (0 === stripos($uri, 'https://')) {
        $protocol = 'https://';
        $uri      = substr($uri, 8);
    } else {
        $protocol = '';
    }

    if (strpos($uri, '?') !== false) {
        list($base, $query) = explode('?', $uri, 2);
        $base                .= '?';
    } elseif ($protocol || strpos($uri, '=') === false) {
        $base  = $uri . '?';
        $query = '';
    } else {
        $base  = '';
        $query = $uri;
    }

    parse_str($query, $qs);
    $qs = urlencode_deep($qs); // This re-URL-encodes things that were already in the query string.
    if (is_array($args[0])) {
        foreach ($args[0] as $k => $v) {
            $qs[$k] = $v;
        }
    } else {
        $qs[$args[0]] = $args[1];
    }

    foreach ($qs as $k => $v) {
        if (false === $v) {
            unset($qs[$k]);
        }
    }

    $ret = build_query($qs);
    $ret = trim($ret, '?');
    $ret = preg_replace('#=(&|$)#', '$1', $ret);
    $ret = $protocol . $base . $ret . $frag;
    $ret = rtrim($ret, '?');
    return $ret;
}

function _http_build_query($data, $prefix = null, $sep = null, $key = '', $urlencode = true)
{
    $ret = array();

    foreach ((array) $data as $k => $v) {
        if ($urlencode) {
            $k = urlencode($k);
        }
        if (is_int($k) && null != $prefix) {
            $k = $prefix . $k;
        }
        if (!empty($key)) {
            $k = $key . '%5B' . $k . '%5D';
        }
        if (null === $v) {
            continue;
        } elseif (false === $v) {
            $v = '0';
        }

        if (is_array($v) || is_object($v)) {
            array_push($ret, _http_build_query($v, '', $sep, $k, $urlencode));
        } elseif ($urlencode) {
            array_push($ret, $k . '=' . urlencode($v));
        } else {
            array_push($ret, $k . '=' . $v);
        }
    }

    if (null === $sep) {
        $sep = ini_get('arg_separator.output');
    }

    return implode($sep, $ret);
}

function build_query($data)
{
    return _http_build_query($data, null, '&', '', false);
}
function wp_allowed_protocols()
{
    static $protocols = array();

    if (empty($protocols)) {
        $protocols = array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'irc6', 'ircs', 'gopher', 'nntp', 'feed', 'telnet', 'mms', 'rtsp', 'sms', 'svn', 'tel', 'fax', 'xmpp', 'webcal', 'urn');
    }

    return $protocols;
}

function maybe_unserialize($data)
{
    if (is_serialized($data)) { // Don't attempt to unserialize data that wasn't serialized going in.
        return @unserialize(trim($data));
    }

    return $data;
}
function is_serialized($data, $strict = true)
{
    // If it isn't a string, it isn't serialized.
    if (!is_string($data)) {
        return false;
    }
    $data = trim($data);
    if ('N;' === $data) {
        return true;
    }
    if (strlen($data) < 4) {
        return false;
    }
    if (':' !== $data[1]) {
        return false;
    }
    if ($strict) {
        $lastc = substr($data, -1);
        if (';' !== $lastc && '}' !== $lastc) {
            return false;
        }
    } else {
        $semicolon = strpos($data, ';');
        $brace     = strpos($data, '}');
        // Either ; or } must exist.
        if (false === $semicolon && false === $brace) {
            return false;
        }
        // But neither must be in the first X characters.
        if (false !== $semicolon && $semicolon < 3) {
            return false;
        }
        if (false !== $brace && $brace < 4) {
            return false;
        }
    }
    $token = $data[0];
    switch ($token) {
        case 's':
            if ($strict) {
                if ('"' !== substr($data, -2, 1)) {
                    return false;
                }
            } elseif (false === strpos($data, '"')) {
                return false;
            }
            // Or else fall through.
        case 'a':
        case 'O':
            return (bool) preg_match("/^{$token}:[0-9]+:/s", $data);
        case 'b':
        case 'i':
        case 'd':
            $end = $strict ? '$' : '';
            return (bool) preg_match("/^{$token}:[0-9.E+-]+;$end/", $data);
    }
    return false;
}
function get_gravatar($email, $s = 80, $d = 'mp', $r = 'g', $img = false, $atts = array())
{
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5(strtolower(trim($email)));
    $url .= "?s=$s&d=$d&r=$r";
    if ($img) {
        $url = '<img src="' . $url . '"';
        foreach ($atts as $key => $val)
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}

function jn_die($message)
{
    echo $message;
    die;
}

function timezone()
{
    return new DateTimeZone(timezone_string());
}
function timezone_string()
{
    $timezone_string = get_option('timezone_string');

    if ($timezone_string) {
        return $timezone_string;
    }

    $offset  = (float) get_option('gmt_offset');
    $hours   = (int) $offset;
    $minutes = ($offset - $hours);

    $sign      = ($offset < 0) ? '-' : '+';
    $abs_hour  = abs($hours);
    $abs_mins  = abs($minutes * 60);
    $tz_offset = sprintf('%s%02d:%02d', $sign, $abs_hour, $abs_mins);

    return $tz_offset;
}
function mysql2date($format, $date)
{
    if (empty($date)) {
        return false;
    }

    $datetime = date_create($date, timezone());

    if (false === $datetime) {
        return false;
    }

    // Returns a sum of timestamp with timezone offset. Ideally should never be used.
    if ('G' === $format || 'U' === $format) {
        return $datetime->getTimestamp() + $datetime->getOffset();
    }
    return $datetime->format($format);
}

function get_site_url($path = '')
{
    $url = get_option('siteurl');
    if ($path && is_string($path)) {
        $url .= '/' . ltrim($path, '/');
    }
    return $url;
}
function get_theme_url($path = false)
{
    $url = get_option('siteurl') . "/content/themes/" . get_option('active_theme');
    if ($path && is_string($path)) {
        $url .= '/' . ltrim($path, '/');
    }
    return $url;
}
function get_plugin_url($path)
{
    $url = get_option('siteurl') . "/content/plugin/";
    if ($path && is_string($path)) {
        $url .= '/' . ltrim($path, '/');
    }
    return $url;
}
function get_cache($key, $group)
{
    global $cache;
    return $cache->get($key, $group);
}
function set_cache($key, $value, $group)
{
    global $cache;
    return $cache->set($key, $value, $group);
}

function is_index()
{
    global $CORE;
    return $CORE->get_page_type() === 'index';
}
function is_category()
{
    global $CORE;
    return $CORE->get_page_type() === 'category';
}
function is_404()
{
    global $CORE;
    return $CORE->get_page_type() === '404';
}
function is_product()
{
    global $CORE;
    return $CORE->get_page_type() === 'product';
}
function is_cart()
{
    global $CORE;
    return $CORE->get_page_type() === 'cart';
}

function is_mobile()
{
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

