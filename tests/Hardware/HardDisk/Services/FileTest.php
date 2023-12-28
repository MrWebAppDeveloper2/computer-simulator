<?php

namespace Tests\Hardware\HardDisk\Services;

use Mahmodi\ComputerSimulator\Hardware\Storage\HardDisk;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use Tests\Hardware\HardDisk\Traits\RefreshStorage;

trait FileTest
{
    use RefreshStorage;

    public function test_create_file_method_is_ok_when_file_directory_is_not_exists_and_does_not_build_before()
    {
        $filePath = '/test/fakeDir/readme.txt';

        $content = "Hello world !";

        $this->assertTrue(HardDisk::file()->create($filePath, $content));

        $this->assertEquals($content, HardDisk::file()->fetch($filePath));
    }

    /**
     * @throws \Exception
     */
    #[Depends('test_create_directory_method', 'test_fetch_file_method_service_return_value_is_ok_and_same_with_original_file_content')]
    public function test_create_file_method_is_ok_when_file_directory_is_exists_and_does_build_before()
    {
        $dir = 'test/sub';

        $filePath = $dir . '/readme.txt';

        $content = 'Hello World !';

        HardDisk::directory()->create($dir);

        $this->assertTrue(HardDisk::file()->create($filePath, $content));

        $this->assertEquals($content, HardDisk::file()->fetch($filePath));
    }

    public function test_delete_file_method_service_throws_exception_when_file_path_is_fake_and_strict_flag_is_true()
    {
        $this->expectException(\Exception::class);

        HardDisk::file()->delete('/test/sub/fake.txt', true);
    }

    #[Depends('test_fetch_file_method_service_return_value_is_ok_and_same_with_original_file_content', 'test_create_file_method_is_ok_when_file_directory_is_not_exists_and_does_not_build_before')]
    public function test_delete_file_method_service_is_ok_and_file_is_actually_deleted()
    {
        $dir = 'test/sub';

        $filePath = $dir . '/readme.txt';

        $content = 'Hello World !';

        $this->assertTrue(HardDisk::file()->create($filePath, $content));
        
        $this->assertTrue(HardDisk::file()->delete($filePath));
        
        $this->assertEquals($content, HardDisk::file()->fetch($filePath));
    }

    public function test_copy_file_method_service_throws_exception_when_file_path_is_fake()
    {
        $this->expectException(\Exception::class);
        
        HardDisk::file()->copy('test/sub/fake.txt', 'test/sub2/fake.txt');
    }

    #[Depends('test_create_file_method_is_ok_when_file_directory_is_not_exists_and_does_not_build_before')]
    public function test_copy_file_method_service_throws_exception_when_there_is_same_filename_in_destination_directory_and_replace_flag_is_false()
    {
        $directories = [
            'test/sub',
            'test/sub2'
        ];

        $contents = [
            'Hello World !',
            'Hello Mr !'
        ];

        $filename = 'readme.txt';

        foreach ($directories as $index => $directory)
            $this->assertTrue(HardDisk::file()->create($directory . '/' . $filename, $contents[$index]));

        $this->expectException(\Exception::class);

        HardDisk::file()->copy($directories[0] . '/' . $filename, $directories[1]. '/' . $filename, false);
    }

    #[Depends('test_fetch_file_method_service_return_value_is_ok_and_same_with_original_file_content', 'test_create_file_method_is_ok_when_file_directory_is_not_exists_and_does_not_build_before')]
    public function test_copy_file_method_service_done_when_there_is_same_filename_in_destination_directory_but_replace_flag_is_true()
    {
        $directories = [
            'test/sub',
            'test/sub2'
        ];

        $contents = [
            'Hello World !',
            'Hello Mr !'
        ];

        $filename = 'readme.txt';

        foreach ($directories as $index => $directory)
            $this->assertTrue(HardDisk::file()->create($directory . '/' . $filename, $contents[$index]));

        $this->assertTrue(HardDisk::file()->copy($directories[0] . '/' . $filename, $directories[1]. '/' . $filename, true));

        $this->assertSame($contents[0], HardDisk::file()->fetch($directories[1] . '/' . $filename));
    }

    #[Depends('test_fetch_file_method_service_return_value_is_ok_and_same_with_original_file_content', 'test_create_file_method_is_ok_when_file_directory_is_not_exists_and_does_not_build_before')]
    public function test_copy_file_method_service_done_when_there_is_no_same_filename_in_destination_directory()
    {
        $directories = [
            'test/sub',
            'test/sub2'
        ];

        $filename = 'readme.txt';

        $content = 'Hello World !';

        $this->assertTrue(HardDisk::file()->create($directories[0] . '/' . $filename, $content));

        $this->assertTrue(HardDisk::file()->copy($directories[0] . '/' . $filename, $directories[1] . '/' . $filename));

        $this->assertSame(HardDisk::file()->fetch($directories[1] . '/' . $filename), $content);
    }

    public function test_fetch_file_method_service_returns_null_when_file_address_is_fake_and_does_not_exists()
    {
        $this->assertNull(HardDisk::file()->fetch('test/sub/readme.txt'));
    }

    public function test_fetch_file_method_service_return_value_is_ok_and_same_with_original_file_content()
    {
        $filePath = 'test/sub/readme.txt';

        $content = 'Hello World !';

        $this->assertTrue(HardDisk::file()->create($filePath, $content));

        $this->assertSame($content, HardDisk::file()->fetch($filePath));
    }
}