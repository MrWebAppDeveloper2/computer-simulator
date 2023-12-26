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
     * @param bool $replace
     * @return bool
     * @throws \Exception
     */
    public function copy(string $path, string $where, bool $replace = false): bool
    {
        if(!file_exists($file = $this->getRealPath($path)))
            throw new \Exception($path . ' file not found for copy this !');

        if(file_exists($destination = $this->getRealPath($where)))
            if(!$replace)
                throw new \Exception('Can not copy ' . $path . ' file to ' . $where . ' because file already exists !');
            else
                unlink($destination);

        return copy($file, $destination);
    }

    /**
     * Create new file in $path
     *
     * @param string $path
     * @param string $content
     * @return bool
     * @throws \Exception
     */
    public function create(string $path, string $content): bool
    {
        $realPath = $this->getRealPath($path);

        if(!is_dir(dirname($realPath)))
            if(!HardDisk::directory()->create(dirname($path)))
                throw new \Exception("Create new file doesn't successful because create file directory returns false and directory doesn't build !");

        return file_put_contents($realPath, $content) !== false;
    }

    /**
     * Find file in HardDisk storage and return its content
     *
     * @param string $path
     * @return string
     * @throws \Exception
     */
    public function fetch(string $path): string
    {
        $realPath = $this->getRealPath($path);

        if(!is_file($realPath))
            throw new \Exception($path . ' file not found for fetch its content !');

        return file_get_contents($realPath);
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