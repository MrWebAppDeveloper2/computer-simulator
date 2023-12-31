<?php

namespace Mahmodi\ComputerSimulator\Hardware\Storage\Trait;

use JetBrains\PhpStorm\Pure;
use Mahmodi\ComputerSimulator\Hardware\Storage\Service\DirectoryService\Directory;
use Mahmodi\ComputerSimulator\Hardware\Storage\Service\DirectoryService\IHardDiskDirectoryService;
use Mahmodi\ComputerSimulator\Hardware\Storage\Service\FileService\File;
use Mahmodi\ComputerSimulator\Hardware\Storage\Service\FileService\IHardDiskFileService;

/**
 * Includes all HardDisk's service classes method factory
 *
 * Implements factory method design pattern for instantiate
 * service classes
 */
trait HasServiceFactory
{
    /**
     * Singleton Design Pattern property
     *
     * Stores built instances of services for prevent
     * rebuild in the future
     *
     * @var array
     */
    private static array $serviceInstances;

    /**
     * Returns Directory service instance
     *
     * @return Directory
     */
    public static function directory():IHardDiskDirectoryService
    {
        if(!isset(self::$serviceInstances['directory']))
            self::$serviceInstances['directory'] = new Directory();

        return self::$serviceInstances['directory'];
    }

    /**
     * Returns File service instance
     *
     * @return IHardDiskFileService
     */
    public static function file():IHardDiskFileService
    {
        if(!isset(self::$serviceInstances['file']))
            self::$serviceInstances['file'] = new File();

        return self::$serviceInstances['file'];
    }
}