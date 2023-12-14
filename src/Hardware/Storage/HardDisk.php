<?php

namespace Mahmodi\ComputerSimulator\Hardware\Storage;

use Mahmodi\ComputerSimulator\Hardware\Storage\Trait\HasServiceFactory;

class HardDisk
{
    use HasServiceFactory;

    /**
     * Hard disk root directory name
     */
    private const ROOT_DIRECTORY = 'root/';

    /**
     * Returns root directory path address
     *
     * @return string
     */
    public static function rootDirectoryPath():string
    {
        return rtrim(__DIR__ . DIRECTORY_SEPARATOR . self::ROOT_DIRECTORY, '/\\ .');
    }
}
