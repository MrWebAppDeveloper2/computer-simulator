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
        $directory = rtrim(__DIR__ . DIRECTORY_SEPARATOR . self::ROOT_DIRECTORY, '/\\ .');

        if (!is_dir($directory))
            mkdir($directory, 0777, true);

        return $directory;
    }
}
