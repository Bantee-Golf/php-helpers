<?php


use EMedia\PHPHelpers\Files\Loader as LoaderAlias;
use PHPUnit\Framework\TestCase;

class LoaderTest extends TestCase
{
    private static $dir = "_loader_test";
    private static $subdir = "_loader_test/sub";

    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        mkdir(static::$dir);
        mkdir(static::$subdir, 0777, true);
    }

    protected function tearDown()
    {
        system('rm -rf -- ' . escapeshellarg(static::$dir));
        parent::tearDown(); // TODO: Change the autogenerated stub
    }

    /**
     * @test
     */
    public function test_Loader_includes_class_in_dir()
    {
        $classes = [
            static::$dir => 'ClassOne',
            static::$dir => 'ClassTwo',
            static::$subdir => 'SubDirectoryClass'
        ];

        foreach ($classes as $directory => $class) {
            $this->assertFalse(class_exists($class));
        }

        foreach ($classes as $directory => $class) {
            $this->generateClassFile($directory, $class);
        }

        LoaderAlias::includeAllFilesFromDir(static::$dir);

        foreach ($classes as $directory => $class) {

            if ($directory === static::$dir) {
                $this->assertTrue(class_exists($class));
            }

            if ($directory === static::$subdir) {
                $this->assertFalse(class_exists($class));
            }
        }
    }

    /**
     * @test
     */
    public function test_Loader_includes_class_in_all_subdirectories_too()
    {
        $classes = [
            static::$dir => 'ClassOne',
            static::$dir => 'ClassTwo',
            static::$subdir => 'SubDirectoryClass'
        ];

        foreach ($classes as $directory => $class) {
            $this->assertFalse(class_exists($class));
        }

        foreach ($classes as $directory => $class) {
            $this->generateClassFile($directory, $class);
        }

        LoaderAlias::includeAllFilesFromDirRecursive(static::$dir);

        foreach ($classes as $directory => $class) {
            $this->assertTrue(class_exists($class));
        }
    }

    private function generateClassFile($dir, $name)
    {
        $content = "<?php \r class ${name} \r { \r \r }";
        file_put_contents($dir . "/{$name}.php", $content);
    }
}