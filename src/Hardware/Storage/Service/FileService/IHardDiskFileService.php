<?php

namespace Mahmodi\ComputerSimulator\Hardware\Storage\Service\FileService;

interface IHardDiskFileService
{
    /**
     * Copy $path file to $where  path
     *
     * @param string $path
     * @param string $where is file filename address. for
     * example: /root/copyDirectory/file.txt
     * @param bool $replace
     * @return bool
     */
    public function copy(string $path, string $where, bool $replace = false):bool;

    /**
     * Create new file in $path
     *
     * @param string $path
     * @param string $content
     * @return bool
     */
    public function create(string $path, string $content):bool;

    /**
     * Find file in HardDisk storage and return its content
     *
     * @param string $path
     * @return string
     */
    public function fetch(string $path):string;

    /**
     * Delete $path file
     *
     * @param string $path
     * @param bool $strict When it is true, if $path is not exists an exception will throw
     * @return bool
     */
    public function delete(string $path, bool $strict = false):bool;
}