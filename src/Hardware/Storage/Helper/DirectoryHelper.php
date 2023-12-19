<?php

namespace Mahmodi\ComputerSimulator\Hardware\Storage\Helper;

class DirectoryHelper
{
    /**
     * Delete a directory event it doesn't empty
     *
     * When entry directory path is a dir that
     * doesn't empty, it starts to iterate dir
     * indexes for delete, and it can continue
     * even all subdirectories and files deleted
     * then entry directory ($dir) will delete
     *
     * @param $dir
     * @return bool
     */
    public static function deleteDirectory($dir):bool
    {
        if (!file_exists($dir)) {
            return true;
        }

        if (!is_dir($dir)) {
            return unlink($dir);
        }

        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            if (!self::deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }

        }

        return rmdir($dir);
    }
}