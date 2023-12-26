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
     * Returns Directory service instance
     *
     * @return Directory
     */
    #[Pure] public static function directory():IHardDiskDirectoryService
    {
        return new Directory();
    }

    /**
     * Returns File service instance
     *
     * @return IHardDiskFileService
     */
    #[Pure] public static function file():IHardDiskFileService
    {
        return new File();
    }
}