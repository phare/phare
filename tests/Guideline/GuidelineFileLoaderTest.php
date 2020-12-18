<?php

namespace Phare\Tests\Guideline;

use Phare\Guideline\GuidelineFileLoader;
use PHPUnit\Framework\TestCase;

class GuidelineFileLoaderTest extends TestCase
{
    public function test_it_load_guideline()
    {
        self::assertEquals(
            require __DIR__ . '/../../src/Guideline/preset/laravel.php',
            GuidelineFileLoader::load('src/Guideline/preset/laravel.php')
        );
    }

    public function test_it_load_default_guideline_if_wrong_file_path()
    {
        self::assertEquals(
            require __DIR__ . '/../../src/Guideline/preset/default.php',
            GuidelineFileLoader::load('src/Guideline/preset/wrong.php')
        );
    }
}
