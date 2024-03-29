<?php

namespace Tests\Hardware\HardDisk;

use PHPUnit\Framework\TestCase;
use Tests\Hardware\HardDisk\Services\DirectoryTest;
use Tests\Hardware\HardDisk\Services\FileTest;
use Tests\Hardware\HardDisk\Traits\RefreshStorage;

class HardDiskTest extends TestCase
{
    use RefreshStorage, DirectoryTest, FileTest;
}