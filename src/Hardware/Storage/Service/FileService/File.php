<?php

namespace Mahmodi\ComputerSimulator\Hardware\Storage\Service\FileService;

use Mahmodi\ComputerSimulator\Hardware\Storage\HardDisk;
use Mahmodi\ComputerSimulator\Hardware\Storage\Service\DirectoryService\IHardDiskDirectoryService;

class File implements IHardDiskFileService
{

    /**
     * Copy $path file to $where  path
     *
     * @param string $path
     * @param string $where is file filename address. for
     * example: /root/copyDirectory/file.txt
     * @return bool
     */
    public function copy(string $path, string $where): bool
    {
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
    public function getRealPath(string $path): string
    {
        $root = HardDisk::rootDirectoryPath();

        return $root . DIRECTORY_SEPARATOR . trim($path, '/\\ .');
    }
}