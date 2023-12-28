<?php

namespace Mahmodi\ComputerSimulator\Hardware\Storage\Service\DirectoryService;

use Exception;
use Mahmodi\ComputerSimulator\Hardware\Storage\HardDisk;
use Mahmodi\ComputerSimulator\Hardware\Storage\Service\FileService\File;
use Mahmodi\ComputerSimulator\Hardware\Storage\Service\FileService\IHardDiskFileService;

/**
 * Includes all function related to hard disk directory
 *
 * Such as create ,delete ,scan directory
 */
class Directory implements IHardDiskDirectoryService
{
    /**
     * File service object
     *
     * @var IHardDiskFileService
     */
    private static IHardDiskFileService $file;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        self::initialFileService();
    }

    /**
     * Create new instance of file service object then
     * store in property
     *
     * @return void
     * @throws Exception
     */
    private static function initialFileService(): void
    {
        try {
            if (!isset(self::$file))
                self::$file = new File();
        } catch (Exception $e) {
            throw new $e;
        }
    }

    /**
     * Makes enter path directory in computer hard disk root directory
     *
     * @param string $path
     * @return boolean
     * @throws \Exception
     */
    public function create(string $path): bool
    {
        $directory = $this->getRealPath($path);

        if (!is_dir($directory))
            if (!mkdir($directory, 0777, true))
                throw new \Exception('Create folder unsuccessful !');

        return true;
    }

    /**
     * Delete enter path directory from computer hard disk root directory
     *
     * @param string $path
     * @param bool $strict if be true when $path directory address not valid ,
     * returns false else ignores and returns true
     * @return bool
     */
    public function delete(string $path, bool $strict = false): bool
    {
        $directory = !is_dir($path) ? $this->getRealPath($path) : $path;

        if (!is_dir($directory))
            return !$strict;

        foreach (scandir($directory) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            $itemPath = $directory . DIRECTORY_SEPARATOR . $item;

            if (is_dir($itemPath))
                if (!self::delete($itemPath))
                    return false;
                else
                    continue;

            unlink($itemPath);
        }

        return rmdir($directory);
    }

    /**
     * Moves entry directory path to new path that is $where path address
     *
     * If parent directory of target directory is same and have not any diff
     * by current, this function acts as renaming directory service as well
     *
     * @param string $path
     * @param string $where
     * @param bool $replace
     * @return bool
     * @throws \Exception
     */
    public function move(string $path, string $where, bool $replace = false): bool
    {
        if (!is_dir($directory = $this->getRealPath($path)))
            return false;

        if (is_dir($destinationDirectory = $this->getRealPath($where)))
            if (!$replace)
                return false;
            else
                if (!self::delete($destinationDirectory))
                    throw new \Exception('Remove directory for replace new unsuccessfully in move directory method !');

        if (dirname($directory) === dirname($destinationDirectory))
            return rename($directory, $destinationDirectory);

        if (!$this->copy($path, $where))
            throw new \Exception('Copy target directory ($path) to destination directory ($where) was not successful in move directory service');

        return self::delete($path);
    }

    /**
     * @throws Exception
     */
    public function copy(string $path, string $where, bool $replace = true): bool
    {
        if (!is_dir($directory = $this->getRealPath($path)))
            throw new Exception("Copy $path directory unsuccessful because this directory not found !");

        if (is_dir($destinationDirectory = $this->getRealPath("$where"))) {
            if (!$replace)
                return false;
            else
                if (!self::delete($destinationDirectory))
                    throw new \Exception('Remove directory for replace new unsuccessfully in copy directory method !');
        }

        $this->create("$where");

        $assets = scandir($directory); // directory file and directory members

        foreach ($assets as $name){
            if($name == '.' || $name == '..')
                continue;

            switch ($assetPath = $directory . DIRECTORY_SEPARATOR . $name){
                case is_dir($assetPath):{
                    $this->copy("$path/$name", "$where/$name", $replace);
                    break;
                }
                case is_file($assetPath):{
                    copy($assetPath, $destinationDirectory . DIRECTORY_SEPARATOR . $name);
                    break;
                }
                default:{
                    throw new Exception('Unable error was encounter in copy directory service !');
                }
            }
        }

        return true;
    }

    /**
     * Returns list of directories and files within entry $path directory
     * False returns if $path is not valid
     *
     * @param string $path
     * @param bool $hidden if be true hidden files and directories add to return list
     * @return array|false
     * @throws Exception
     */
    public function list(string $path, bool $hidden = false): array|false
    {
        if (!is_dir($directory = $this->getRealPath($path)))
            throw new Exception("$path directory not found in directory list service method !");

        $list = scandir($directory);

        if (!$hidden)
            foreach ($list as $index => $name)
                if (str_starts_with($name, '.'))
                    unset($list[$index]);

        return $list;
    }

    /**
     * Returns concatenate of root directory with entry $path parameter
     *
     * @param string $path
     * @return string
     */
    public function getRealPath(string $path): string
    {
        $root = HardDisk::rootDirectoryPath();

        return $root . DIRECTORY_SEPARATOR . trim($path, '/\\ .');
    }

    /**
     * It cleans up Hard Disk by delete root directory
     *
     * @return bool
     */
    public function resetFactory(): bool
    {
        $root = HardDisk::rootDirectoryPath();

        return self::delete($root);
    }
}
