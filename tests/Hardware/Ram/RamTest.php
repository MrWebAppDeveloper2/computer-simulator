<?php

namespace Tests\Hardware\Ram;

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use Tests\Hardware\Ram\Traits\RefreshRam;

class RamTest extends TestCase
{
    use RefreshRam;

    /**
     * Asserts that Ram`s save method service works
     * fine and passed data stored
     *
     * @return void
     */
    #[Depends('test_fetch_method_service_is_ok')]
    public function test_save_method_service_is_ok()
    {
        $this->assertTrue(true);
    }

    /**
     * Asserts new data replace instead old data when entry keyword set in past ( Update operation )
     *
     * @return void
     */
    #[Depends('test_fetch_method_service_is_ok')]
    public function test_save_method_service_works_fine_for_update_an_exists_data()
    {
        $keyword = 'test';

        $firstData = 'Hello world !';

        $newData = "This is test text !";

        $this->assertTrue(self::$ram->save($keyword, $firstData));

        $this->assertSame($firstData, self::$ram->fetch($keyword));

        $this->assertTrue(self::$ram->save($keyword, $newData));

        $this->assertSame($newData, self::$ram->fetch($keyword));
    }

    /**
     * Assert fetch method service throws error when entry keyword arg is fake
     *
     * @return void
     */
    public function test_fetch_method_service_throws_error_when_entry_keyword_argument_value_is_fake_and_is_not_set()
    {
        $this->expectException(\Exception::class);

        self::$ram->fetch('fake_keyword');
    }

    /**
     * Assert fetch method service works fine
     *
     * @return void
     */
    public function test_fetch_method_service_is_ok()
    {
        $keyword = 'test';

        $data = 'Hello world !';

        $this->assertTrue(self::$ram->save($keyword, $data));

        $this->assertSame($data, self::$ram->fetch($keyword));
    }

    /**
     * Assert remove method service throws error when entry keyword arg is fake
     *
     * @return void
     */
    public function test_remove_method_service_throws_error_when_entry_keyword_argument_value_is_fake_and_is_not_set()
    {
        $this->expectException(\Exception::class);

        self::$ram->remove('fake_keyword');
    }

    /**
     * Assert fetch method service works fine
     *
     * @return void
     */
    public function test_remove_method_service_is_ok()
    {
        $keyword = 'test';

        $data = 'Hello world !';

        $this->assertTrue(self::$ram->save($keyword, $data));

        $this->assertSame($data, self::$ram->fetch($keyword));

        $this->assertTrue(self::$ram->remove($keyword));

        $this->expectException(\Exception::class);

        self::$ram->remove('fake_keyword');
    }
}