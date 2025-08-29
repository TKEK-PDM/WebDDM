<?php
if (! function_exists('css')) {

    function css($uri = '')
    {
        $css_string = "<link rel='stylesheet' type='text/css' href='" . $uri . "'>";
        return $css_string;
    }
}

if (! function_exists('css_url')) {

    function css_url($uri = '')
    {
        $CI = & get_instance();
        return $CI->config->base_url("/public/css" . $uri);
    }
}

if (! function_exists('js')) {

    function js($uri = '')
    {
        $javascript_string = "<script type='text/javascript' src='" . $uri . "'></script>";
        return $javascript_string;
    }
}

if (! function_exists('js_url')) {

    function js_url($uri = '')
    {
        $CI = & get_instance();
        return $CI->config->base_url("/public/js" . $uri);
    }
}

if (! function_exists('public_url')) {

    function public_url($uri = '')
    {
        $CI = & get_instance();
        $public_url = $CI->config->base_url("/public" . $uri);
        return $public_url;
    }
}