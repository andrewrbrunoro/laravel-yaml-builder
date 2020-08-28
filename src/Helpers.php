<?php
if (!function_exists('str_var_replace')) {
    function str_var_replace(
        $string,
        $array,
        $pattern = '~\${(.*?)}~si'
    )
    {
        return preg_replace_callback($pattern, function ($match) use ($array) {
            return str_replace($match[0], isset($array[$match[1]]) ? $array[$match[1]] : $match[0], $match[0]);
        }, $string);
    }
}
