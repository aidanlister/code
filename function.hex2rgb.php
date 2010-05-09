<?php

/**
 * Convert a Color-HEX string into an RGB string
 *
 * @version     1.0.0
 * @author      Aidan Lister <aidan@php.net>
 * @link        http://aidanlister.com/repos/v/function.convert_hex2rgb.php
 * @param       string  $hex        The hex string
 * @param       string  $format     Format of the output
 */
function hex2rgb ($hex, $format = 'rgb(%d, %d, %d)')
{
    if (strlen($hex) === 3) {
        $rgb = sprintf($format,
            hexdec($hex[0]),
            hexdec($hex[1]),
            hexdec($hex[2]));
    } elseif (strlen($hex) === 6) {
        $rgb = sprintf($format,
            hexdec(substr($hex, 0, 2)),
            hexdec(substr($hex, 2, 2)),
            hexdec(substr($hex, 4, 2)));
    } else {
        $rgb = false;
    }

    return $rgb;
}

