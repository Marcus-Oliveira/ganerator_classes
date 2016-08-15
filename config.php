<?php

//echo __DIR__;die();

require __DIR__.'/vendor/autoload.php';

define('DS', DIRECTORY_SEPARATOR);

/**
 * Create  Directory Tree if Not Exists
 * <br/>If you are passing a path with a filename on the end, pass true as the second parameter to snip it off
 * @param string $pathname
 * @param bool $is_filename
 * @return boolean
 */
function make_path($pathname, $is_filename = false) {
    if ($is_filename) {
        $pathname = substr($pathname, 0, strrpos($pathname, '/'));
    }
    // Check if directory already exists
    if (is_dir($pathname) || empty($pathname)) {
        return true;
    }

    // Ensure a file does not already exist with the same name
    $pathname = str_replace(array('/', '\\'), DS, $pathname);
    if (is_file($pathname)) {
        trigger_error('mkdirr() File exists', E_USER_WARNING);
        return false;
    }
    // Crawl up the directory tree
    $next_pathname = substr($pathname, 0, strrpos($pathname, DS));
    if (make_path($next_pathname)) {
        if (!file_exists($pathname)) {
            $result = mkdir($pathname);
            chmod($pathname, 0775);
            return $result;
        }
    }
    return false;
}

?>