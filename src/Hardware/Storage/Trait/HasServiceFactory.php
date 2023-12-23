<?php

namespace Mahmodi\ComputerSimulator\Hardware\Storage\Trait;

use JetBrains\PhpStorm\Pure;
use Mahmodi\ComputerSimulator\Hardware\Storage\Service\DirectoryService\Directory;

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
    #[Pure] public static function directory():Directory
    {
        return new Directory();
    }
}