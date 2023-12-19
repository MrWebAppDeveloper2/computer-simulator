<?php

namespace Tests\Hardware\HardDisk\Services;

use Mahmodi\ComputerSimulator\Hardware\Storage\HardDisk;
use PHPUnit\Framework\TestCase;
use Tests\Hardware\HardDisk\Traits\RefreshStorage;

class DirectoryTest extends TestCase
{
    use RefreshStorage;

    /**
     * Tests create method of HardDisk's Directory Service
     *
     * @return void
     * @throws \Exception
     */
    public function test_create_directory_method()
    {
        $this->assertTrue(HardDisk::directory()->create('test'));

        $this->assertDirectoryExists(HardDisk::directory()->getRealPath('test'));
    }

    /**
     * Asserts when client give fake directory path to
     * Directory Service it returns false
     *
     * @return void
     */
    public function test_delete_directory_method_return_false_when_path_is_fake()
    {
        $this->assertFalse(HardDisk::directory()->delete('fake/directory'));
    }

    /**
     * Tests delete method of HardDisk's Directory Service
     *
     * @return void
     * @throws \Exception
     */
    public function test_delete_directory_method()
    {
        $this->assertTrue(HardDisk::directory()->create('test'));

        $this->assertDirectoryExists(HardDisk::directory()->getRealPath('test'));

        $this->assertTrue(HardDisk::directory()->delete('test'));

        $this->assertDirectoryDoesNotExist(HardDisk::directory()->getRealPath('test'));
    }

    /**
     * Asserts when client give fake directory path of
     * target directory for get list ,Service returns false
     *
     * @return void
     */
    public function test_list_directory_method_return_false_when_path_is_fake()
    {
        $this->assertFalse(HardDisk::directory()->list('/test/myDirectory'));
    }

    /**
     * Asserts that list directory method service return
     * hidden files and directories when show hidden param
     * true passed successfully
     *
     * @return void
     * @throws \Exception
     */
    public function test_list_directory_method_for_show_hidden_files_and_directory_is_ok()
    {
        $this->assertTrue(HardDisk::directory()->create('/test'));

        $this->assertTrue(HardDisk::file()->create('/test/.myFile.txt', 'Hello World !'));

        $this->assertTrue(HardDisk::directory()->create('/test/.myDirectory'));

        $this->assertTrue(in_array(['.myDirectory', '.myFile.txt'], HardDisk::directory()->list('/test/')));
    }

    /**
     * Asserts that list directory method service return
     * correct directory successfully
     *
     * @return void
     * @throws \Exception
     */
    public function test_list_directory_method_is_ok()
    {
        $this->assertTrue(HardDisk::directory()->create('/test'));

        $this->assertTrue(HardDisk::file()->create('/test/myFile.txt', 'Hello World !'));

        $this->assertTrue(HardDisk::directory()->create('/test/myDirectory'));

        $this->assertTrue(in_array(['myDirectory', 'myFile.txt'], HardDisk::directory()->list('/test/')));
    }

    /**
     * Asserts when client give fake directory path of
     * target directory for move ,Service returns false
     *
     * @return void
     * @throws \Exception
     */
    public function test_move_directory_method_return_false_when_path_is_fake()
    {
        $this->assertFalse(HardDisk::directory()->move('myDirectory', '/nested/myDirectory'));
    }

    /**
     * Asserts when there is another directory that its
     * name is same with target directory and replace
     * flag option is false passed , Service returns false
     * and doesn't move complete
     *
     * @return void
     * @throws \Exception
     */
    public function test_move_directory_method_return_false_when_there_is_a_same_name_directory_in_move_path_and_replace_flag_is_false()
    {
        $this->assertTrue(HardDisk::directory()->create('/test/myFirstDirectory'));

        $this->assertTrue(HardDisk::directory()->create('test/mySecondDirectory'));

        $this->assertFalse(HardDisk::directory()->move('/test/mySecondDirectory', '/test/myFirstDirectory', false));
    }

    /**
     * Asserts when there is another directory that its
     * name is same with target directory but replace
     * flag option is true passed , Service returns true
     * and does move complete
     *
     * @return void
     * @throws \Exception
     */
    public function test_move_directory_method_return_true_when_there_is_a_same_name_directory_in_move_path_and_replace_flag_is_true()
    {
        $this->assertTrue(HardDisk::directory()->create('/test/myFirstDirectory'));

        $this->assertTrue(HardDisk::directory()->create('test/mySecondDirectory'));

        $this->assertFalse(HardDisk::directory()->move('/test/mySecondDirectory', '/test/myFirstDirectory', true));
    }

    /**
     * Asserts that move directory method service performs
     * renaming directory successfully
     *
     * @return void
     * @throws \Exception
     */
    public function test_move_directory_method_for_rename_is_ok()
    {
        $this->assertTrue(HardDisk::directory()->create('/test/myDirectory'));

        $this->assertTrue(HardDisk::directory()->move('/test/myDirectory', '/test/myBestDirectory'));

        $this->assertTrue(in_array('myBestDirectory', HardDisk::directory()->list('/test')));

        $this->assertFalse(in_array('myDirectory', HardDisk::directory()->list('/test')));
    }

    /**
     * Asserts that move directory method service performs
     * moving directory to new place successfully
     *
     * @return void
     * @throws \Exception
     */
    public function test_move_directory_method_for_change_place_is_ok()
    {
        $this->assertTrue(HardDisk::directory()->create('/first/myDirectory'));

        $this->assertTrue(HardDisk::directory()->move('/first/myDirectory', '/second/myDirectory'));

        $this->assertTrue(in_array('myDirectory', HardDisk::directory()->list('/second')));

        $this->assertFalse(in_array('myDirectory', HardDisk::directory()->list('/first')));
    }

    /**
     * Asserts when client give fake directory path of
     * target directory for copy ,Service returns false
     *
     * @return void
     */
    public function test_copy_directory_method_return_false_when_path_of_target_directory_is_fake()
    {
        $this->assertFalse(HardDisk::directory()->copy('myDirectory', '/nested'));
    }

    /**
     * Asserts when client give fake directory path of
     * destination directory for copy ,Service returns false
     *
     * @return void
     * @throws \Exception
     */
    public function test_copy_directory_method_return_false_when_path_of_destination_directory_is_fake()
    {
        $this->assertTrue(HardDisk::directory()->create('/myDirectory'));

        $this->assertFalse(HardDisk::directory()->copy('/myDirectory', '/nested'));
    }

    /**
     * Asserts when there is another directory that its
     * name is same with target directory and replace
     * flag option is false passed , Service returns false
     * and doesn't copy
     *
     * @return void
     * @throws \Exception
     */
    public function test_copy_directory_method_return_false_when_there_is_a_same_name_directory_in_copy_path_and_replace_flag_is_false()
    {
        $this->assertTrue(HardDisk::directory()->create('/test/nested/myDirectory'));

        $this->assertTrue(HardDisk::directory()->create('/test/myDirectory'));
        
        $this->assertFalse(HardDisk::directory()->copy('/test/myDirectory', '/test/nested', false));
    }

    /**
     * Asserts when there is another directory that its
     * name is same with target directory and replace
     * flag option is true passed , Service returns true
     * and does copy complete
     *
     * @return void
     * @throws \Exception
     */
    public function test_copy_directory_method_return_true_when_there_is_a_same_name_directory_in_copy_path_and_replace_flag_is_true()
    {
        $this->assertTrue(HardDisk::directory()->create('/test/nested/myDirectory'));

        $this->assertTrue(HardDisk::directory()->create('/test/myDirectory'));

        $this->assertFalse(HardDisk::directory()->copy('/test/myDirectory', '/test/nested', true));
    }

    /**
     * Asserts that copy directory method service performs
     * copy directory successfully
     *
     * @return void
     * @throws \Exception
     */
    public function test_copy_directory_method_is_ok()
    {
        $this->assertTrue(HardDisk::directory()->create('/test/first'));

        $this->assertTrue(HardDisk::directory()->create('/test/first/nested'));

        $this->assertTrue(HardDisk::directory()->create('/test/second'));

        $this->assertTrue(HardDisk::directory()->copy('/test/first', '/test/second'));

        $this->assertTrue(in_array('first', HardDisk::directory()->list('/test/second')));

        $this->assertTrue(in_array('nested', HardDisk::directory()->list('/test/second/first')));
    }
}