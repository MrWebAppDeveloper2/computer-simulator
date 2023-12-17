<?php

namespace Mahmodi\ComputerSimulator\Hardware\Storage\Service;

use Mahmodi\ComputerSimulator\Hardware\Storage\HardDisk;

/**
 * Includes all function related to hard disk directory
 *
 * Such as create ,delete ,scan directory
 */
class Directory
{
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

        if(!is_dir($directory))
            if(!mkdir($directory))
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
    public function delete(string $path, bool $strict = false):bool
    {
        $directory = $this->getRealPath($path);

        if(!is_dir($directory))
            return !$strict;

        return rmdir($directory);
    }

//    /**
//     * Moves entry directory path to new path that is $where path address
//     *
//     * @param string $path
//     * @param string $where
//     * @return bool
//     */
//    public function move(string $path, string $where):bool
//    {
//        if(!is_dir($directory = $this->getRealPath($path)))
//            return false;
//    }

    /**
     * Returns list of directories and files within entry $path directory
     * False returns if $path is not valid
     *
     * @param string $path
     * @param bool $hidden if be true hidden files and directories add to return list
     * @return array|false
     */
    public function list(string $path, bool $hidden = false):array|false
    {
        $directory = $this->getRealPath($path);

        $list = scandir($directory);

        if(!$hidden)
            foreach ($list as $index => $name)
                if(str_starts_with($name, '.'))
                    unset($list[$index]);

        return $list;
    }

    /**
     * Returns concatenate of root directory with entry $path parameter
     *
     * Before return address check that is root directory exists
     * if not makes directory then return address of that
     *
     * @param string $path
     * @return string
     */
    public function getRealPath(string $path):string
    {
        $root = HardDisk::rootDirectoryPath();

        if(!is_dir($root))
            mkdir($root, 0777, true);

        return $root . DIRECTORY_SEPARATOR . trim($path, '/\\ .');
    }
}
