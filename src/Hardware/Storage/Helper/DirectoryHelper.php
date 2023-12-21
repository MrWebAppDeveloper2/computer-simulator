<?php

namespace Mahmodi\ComputerSimulator\Hardware\Storage\Helper;

class DirectoryHelper
{
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