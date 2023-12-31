<?php

namespace Mahmodi\ComputerSimulator\Hardware\Storage\Service\FileService;

use Mahmodi\ComputerSimulator\Hardware\Storage\HardDisk;
use Mahmodi\ComputerSimulator\Hardware\Storage\Service\DirectoryService\Directory;
use Mahmodi\ComputerSimulator\Hardware\Storage\Service\DirectoryService\IHardDiskDirectoryService;

class File implements IHardDiskFileService
{
    /**
     * Instance of directory service will store here
     *
     * @var IHardDiskDirectoryService
     */
    private static IHardDiskDirectoryService $directory;

    /**
     * Returns instance of directory service
     *
     * @return IHardDiskDirectoryService
     */
    private function directoryService(): IHardDiskDirectoryService
    {
        if (!isset(self::$directory))
            self::$directory = new Directory();

        return self::$directory;
    }

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
        if (!file_exists($file = $this->getRealPath($path)))
            throw new \Exception($path . ' file not found for copy this !');

        if (file_exists($destination = $this->getRealPath($where)))
            if (!$replace)
                throw new \Exception('Can not copy ' . $path . ' file to ' . $where . ' because file already exists !');
            else
                unlink($destination);

        if (!is_dir(dirname($file)))
            $this->directoryService()->create(dirname($path));

        if (!is_dir(dirname($destination)))
            $this->directoryService()->create(dirname($where));

        return is_numeric(file_put_contents($destination, $this->fetch($path)));
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

        if (!is_dir(dirname($realPath)))
            if (!HardDisk::directory()->create(dirname($path)))
                throw new \Exception("Create new file doesn't successful because create file directory returns false and directory doesn't build !");

        return file_put_contents($realPath, $content) !== false;
    }

    /**
     * Find file in HardDisk storage and return its content
     *
     * @param string $path
     * @return string|null
     */
    public function fetch(string $path): ?string
    {
        $realPath = $this->getRealPath($path);

        return is_file($realPath) ? file_get_contents($realPath) : null;
    }

    /**
     * Delete $path file
     *
     * @param string $path
     * @param bool $strict When it is true, if $path is not exists an exception will throw
     * @return bool
     * @throws \Exception
     */
    public function delete(string $path, bool $strict = false): bool
    {
        if (!file_exists($realPath = $this->getRealPath($path)))
            if (!$strict)
                return true;
            else
                throw new \Exception($path . ' file not found for delete it !');

        return unlink($realPath);
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