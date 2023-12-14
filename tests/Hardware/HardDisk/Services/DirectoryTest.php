<?php

namespace Tests\Hardware\HardDisk\Services;

use Mahmodi\ComputerSimulator\Hardware\Storage\HardDisk;
use PHPUnit\Framework\TestCase;

class DirectoryTest extends TestCase
{
    /**
     * Tests create method of HardDisk's Directory Service
     *
     * @return void
     * @throws \Exception
     */
    public function test_create_directory()
    {
        HardDisk::directory()->create('test');

        $realPath = HardDisk::directory()->getRealPath('test');

        $this->assertDirectoryExists($realPath);
    }

    /**
     * Tests delete method of HardDisk's Directory Service
     *
     * @return void
     * @throws \Exception
     */
    public function test_delete_directory()
    {
        HardDisk::directory()->create('test');

        $this->assertDirectoryExists(HardDisk::directory()->getRealPath('test'));

        HardDisk::directory()->delete('test');

        $this->assertDirectoryDoesNotExist(HardDisk::directory()->getRealPath('test'));
    }
}