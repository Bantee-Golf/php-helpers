<?php


use EMedia\PHPHelpers\Files\DirManager;
use PHPUnit\Framework\TestCase;

class DirManagerTest extends TestCase
{
    private static $testDirName = "_test_dir";

    protected function tearDown()
    {
        if(is_dir(static::$testDirName)) {
            rmdir(static::$testDirName);
        }
        parent::tearDown();

    }

    /**
     * @test
     * @throws \EMedia\PHPHelpers\Exceptions\FIleSystem\DirectoryNotCreatedException
     */
    public function test_DirManager_makeDirectoryIfNotExists_skips_an_existing_directory()
    {
        if(!is_dir(static::$testDirName)) {
            mkdir(static::$testDirName);
        }

        $success = DirManager::makeDirectoryIfNotExists(static::$testDirName);
        $this->assertTrue($success);
    }

    /**
     * @test
     * @throws \EMedia\PHPHelpers\Exceptions\FIleSystem\DirectoryNotCreatedException
     */
    public function test_DirManager_makeDirectoryIfNotExists_creates_a_new_directory()
    {

        if(is_dir(static::$testDirName)) {
            rmdir(static::$testDirName);
        }

        $success = DirManager::makeDirectoryIfNotExists(static::$testDirName);

        $this->assertTrue($success);
        $this->assertTrue(is_dir(static::$testDirName));
    }

}