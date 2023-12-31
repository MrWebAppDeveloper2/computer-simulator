<?php

namespace Tests\Hardware\Ram\Traits;

trait RefreshRam
{
    /**
     * The new Ram instance will store on it
     *
     * @var Ram|null
     */
    protected static ?Ram $ram = null;

    /**
     * Create new instance of Ram and then store in the property
     * before run test
     *
     * @return void
     */
    protected function tearDown():void
    {
        self::$ram = new Ram();
    }

    /**
     * Destroy created ram instance after executed test
     *
     * @return void
     */
    protected function setUp():void
    {
        self::$ram = null;
    }
}