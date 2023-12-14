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
        $directory = $this->getRootDirectory() . DIRECTORY_SEPARATOR . trim($path, '/\\ .');

        if(!is_dir($directory))
            if(!mkdir($directory))
                throw new \Exception('Create folder unsuccessful !');

        return true;
    }

    /**
     * Returns path of root directory
     *
     * Before return address check that is root directory exists
     * if not makes directory then return address of that
     *
     * @return string
     */
    private function getRootDirectory():string
    {
        $root = HardDisk::rootDirectoryPath();

        if(!is_dir($root))
            mkdir($root, 0777, true);

        return $root;
    }
}
