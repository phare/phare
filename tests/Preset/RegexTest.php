<?php


namespace Phare\Tests\Preset;

use Phare\Preset\Regex;
use PHPUnit\Framework\TestCase;

class RegexTest extends TestCase
{
    public function test_it_check_pascal_case(): void
    {
        $strings = [
            'PascalCase' => true,
            'Pascal Case' => false,
            'Pascal case' => false,
            'pascal Case' => false,
            'Pascal_Case' => false,
            'Pascal-Case' => false,
            'pascalCase' => false,
            'pascalcase' => false,
        ];

        foreach ($strings as $string => $expected) {
            self::assertEquals($expected, preg_match(Regex::PASCAL_CASE, $string));
        }
    }
}
