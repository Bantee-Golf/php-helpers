<?php


use EMedia\PHPHelpers\Files\DirManager;
use PHPUnit\Framework\TestCase;

class DirManagerTest extends TestCase

{
//    /**
//     * @test
//     */
//    public function test_DirManager_()
//    {
//
//    }

    /**
     * @test
     * @throws \EMedia\PHPHelpers\Exceptions\FIleSystem\DirectoryNotCreatedException
     */
    public function test_DirManager_makeDirectoryIfNotExists_skips_an_existing_directory()
    {
        $name = '_test_dir';
        if(is_dir($name)) {
            rmdir($name);
        }
        $this->assertFalse(is_dir($name));
        mkdir($name);

        $success = DirManager::makeDirectoryIfNotExists($name);
        $this->assertTrue($success);

        rmdir($name);
    }

    /**
     * @test
     * @throws \EMedia\PHPHelpers\Exceptions\FIleSystem\DirectoryNotCreatedException
     */
    public function test_DirManager_makeDirectoryIfNotExists_creates_a_new_directory()
    {

        $name = '_test_dir';
        if(is_dir($name)) {
            rmdir($name);
        }

        $success = DirManager::makeDirectoryIfNotExists('_test_dir');

        $this->assertTrue($success);
        $this->assertTrue(is_dir($name));
    }

}