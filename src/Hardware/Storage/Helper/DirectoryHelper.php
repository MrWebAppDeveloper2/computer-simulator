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
    public static function deleteDirectory($dir): bool
    {
        if (!file_exists($dir))
            return true;


        if (!is_dir($dir))
            return unlink($dir);


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

    /**
     * Creates directory by given $dirname path
     *
     * @param string $dirname
     * @param bool $recursive If is true , directories
     * and subdirectories and listed in $dirname path
     * that aren't exists as yet , will create by
     * this function , If is false, function will
     * return false
     * @return bool
     */
    public static function createDirectory(string $dirname, bool $recursive = true): bool
    {
        return mkdir($dirname, 0777, $recursive);
    }

    /**
     * Copy a directory by its content to new path
     *
     * Iterates all content of $path directory and
     * copies that to $where directory address
     *
     * @param string $path
     * @param string $where
     * @param bool $recursive When it is true, if $where directory
     * path doesn't exist at first builds it then continue, if it
     * is false , function will throw an Exception
     * @return bool
     * @throws \Exception
     */
    public static function copyDirectory(string $path, string $where, bool $recursive = true): bool
    {
        if (!is_dir($path))
            throw new \Exception('$path directory not found for perform copy operation.');

        if (!is_dir($where))
            if ($recursive)
                self::createDirectory($where);
            else
                throw new \Exception('$where directory not found for perform copy operation.');

        $path = rtrim($path, '/\\ .');

        $where = rtrim($where, '/\\.');

        $contents = glob($path . DIRECTORY_SEPARATOR . '*');

        foreach ($contents as $address) {
            dd('copy directory contents loop in ' . __METHOD__ . ' is incomplete !');
            $contentPath = $path . DIRECTORY_SEPARATOR . $contentName;

            if (is_dir($contentPath))
                self::copyDirectory();
        }

        return true;
    }
}