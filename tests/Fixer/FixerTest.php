<?php

namespace Phare\Tests\Fixer;

use Phare\Fixer\FileFixer;
use Phare\Fixer\Fixer;
use Phare\Tests\TestCase;

class FixerTest extends TestCase
{
    public function test_it_make_file_fixer(): void
    {
        self::assertInstanceOf(FileFixer::class, (new Fixer())->file());
    }
}
