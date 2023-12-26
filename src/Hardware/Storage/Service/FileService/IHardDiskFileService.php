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
}