<?php

namespace Tests\Hardware\HardDisk\Traits;

use Mahmodi\ComputerSimulator\Hardware\Storage\HardDisk;

/**
 * It cleans up and makes empty storage folder of
 * HardDisk hardware for each test method
 */
trait RefreshStorage
{
    /**
     * Runs before each test method execution
     * and removes all create directories
     *
     * @return void
     */
    protected function setUp():void
    {
        HardDisk::directory()->resetFactory();
    }

    /**
     * Runs after each test method execution
     * and removes all create directories
     *
     * @return void
     */
    protected function tearDown():void
    {
        HardDisk::directory()->resetFactory();
    }
}