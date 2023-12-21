<?php

namespace Mahmodi\ComputerSimulator\Hardware\Storage\Helper;

class DirectoryHelper
{
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