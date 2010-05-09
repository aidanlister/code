<?php

/**
 * Recursively delete the files in a directory via FTP.
 *
 * @author      Aidan Lister <aidan@php.net>
 * @version     1.0.0
 * @link        http://aidanlister.com/2004/04/recursively-deleting-directories-via-ftp/ 
 * @param       resource $ftp_stream   The link identifier of the FTP connection
 * @param       string   $directory    The directory to delete
 */
function ftp_rmdirr($ftp_stream, $directory)
{
    // Sanity check
    if (!is_resource($ftp_stream) ||
        get_resource_type($ftp_stream) !== 'FTP Buffer') {
 
        return false;
    }
 
    // Init
    $i             = 0;
    $files         = array();
    $folders       = array();
    $statusnext    = false;
    $currentfolder = $directory;
 
    // Get raw file listing
    $list = ftp_rawlist($ftp_stream, $directory, true);
 
    // Iterate listing
    foreach ($list as $current) {
        
        // An empty element means the next element will be the new folder
        if (empty($current)) {
            $statusnext = true;
            continue;
        }
 
        // Save the current folder
        if ($statusnext === true) {
            $currentfolder = substr($current, 0, -1);
            $statusnext = false;
            continue;
        }
 
        // Split the data into chunks
        $split = preg_split('[ ]', $current, 9, PREG_SPLIT_NO_EMPTY);
        $entry = $split[8];
        $isdir = ($split[0]{0} === 'd') ? true : false;
 
        // Skip pointers
        if ($entry === '.' || $entry === '..') {
            continue;
        }
 
        // Build the file and folder list
        if ($isdir === true) {
            $folders[] = $currentfolder . '/' . $entry;
        } else {
            $files[] = $currentfolder . '/' . $entry;
        }
 
    }
 
    // Delete all the files
    foreach ($files as $file) {
        ftp_delete($ftp_stream, $file);
    }
 
    // Delete all the directories
    // Reverse sort the folders so the deepest directories are unset first
    rsort($folders);
    foreach ($folders as $folder) {
        ftp_rmdir($ftp_stream, $folder);
    }
 
    // Delete the final folder and return its status
    return ftp_rmdir($ftp_stream, $directory);
}

