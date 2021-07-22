<?php


function _translate_php_url_constant_to_key($constant)
{
    $translation = array(
        PHP_URL_SCHEME   => 'scheme',
        PHP_URL_HOST     => 'host',
        PHP_URL_PORT     => 'port',
        PHP_URL_USER     => 'user',
        PHP_URL_PASS     => 'pass',
        PHP_URL_PATH     => 'path',
        PHP_URL_QUERY    => 'query',
        PHP_URL_FRAGMENT => 'fragment',
    );

    if (isset($translation[$constant])) {
        return $translation[$constant];
    } else {
        return false;
    }
}

function _get_component_from_parsed_url_array($url_parts, $component = -1)
{
    if (-1 === $component) {
        return $url_parts;
    }

    $key = _translate_php_url_constant_to_key($component);
    if (false !== $key && is_array($url_parts) && isset($url_parts[$key])) {
        return $url_parts[$key];
    } else {
        return null;
    }
}

function _parse_url($url, $component = -1)
{
    $to_unset = array();
    $url      = (string) $url;

    if ('//' === substr($url, 0, 2)) {
        $to_unset[] = 'scheme';
        $url        = 'placeholder:' . $url;
    } elseif ('/' === substr($url, 0, 1)) {
        $to_unset[] = 'scheme';
        $to_unset[] = 'host';
        $url        = 'placeholder://placeholder' . $url;
    }

    $parts = parse_url($url);

    if (false === $parts) {
        // Parsing failure.
        return $parts;
    }

    // Remove the placeholder values.
    foreach ($to_unset as $key) {
        unset($parts[$key]);
    }

    return _get_component_from_parsed_url_array($parts, $component);
}
