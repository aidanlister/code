<?php

/**
 * Convert MySQL timestamp to unix timestamp
 *
 * @author      Aidan Lister <aidan@php.net>
 * @version     1.1.0
 * @link        http://aidanlister.com/repos/v/function.convert_timestamp.php
 * @param       string      $timestamp      MySQL timestamp
 */
function mysql2unixtime($timestamp)
{
    $parts = sscanf($timestamp, '%04u%02u%02u%02u%02u%02u');
    $string = vsprintf('%04u-%02u-%02u %02u:%02u:%02u', $parts);
 
    return strtotime($string);
}

