<?php

namespace Mahmodi\ComputerSimulator\Hardware\Interfaces\HardDisk;

use Mahmodi\ComputerSimulator\Hardware\Interfaces\HardDisk\Services\IHardDiskDirectoryService;
use Mahmodi\ComputerSimulator\Hardware\Interfaces\HardDisk\Services\IHardDiskFileService;

interface IHardDisk
{
    public static function directory():IHardDiskDirectoryService;

    public static function file():IHardDiskFileService;
}