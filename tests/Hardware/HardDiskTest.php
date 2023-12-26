<?php

namespace Tests\Hardware;

use PHPUnit\Framework\TestCase;
use Tests\Hardware\HardDisk\Services\DirectoryTest;
use Tests\Hardware\HardDisk\Traits\RefreshStorage;

class HardDiskTest extends TestCase
{
    use RefreshStorage, DirectoryTest;

}