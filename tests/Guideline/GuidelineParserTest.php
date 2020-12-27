<?php

namespace Phare\Tests\Guideline;

use Phare\Guideline\GuidelineParser;
use Phare\Kernel;
use Phare\Preset\Guideline as GuidelinePreset;
use Phare\Preset\Regex;
use Phare\Preset\Scope;
use Phare\Rule\FileExtension;
use Phare\Rule\FileRegex;
use Phare\Tests\TestCase;
use Phare\Tests\Traits\TestFiles;

class GuidelineParserTest extends TestCase
{
    use TestFiles;

    public function guidelineParser(): GuidelineParser
    {
        return Kernel::container()->get(GuidelineParser::class);
    }

    public function test_it_parse_guideline_and_merge_scopes(): void
    {
        $guideline = [
            GuidelinePreset::EXTENDS => [
                GuidelinePreset::SCOPES => [
                    '*' => [
                        Scope::RULES => [
                            new FileExtension(['php', 'js']),
                            new FileRegex(Regex::PASCAL_CASE),
                        ],
                    ],
                ],
            ],

            GuidelinePreset::SCOPES => [
                '*' => [
                    Scope::RULES => [
                        new FileExtension(['php']),
                        new FileRegex(Regex::PASCAL_CASE),
                    ],
                ],
            ],
        ];

        $values = $this->guidelineParser()->parse($guideline);

        self::assertCount(1, $values[GuidelinePreset::SCOPES]);
        self::assertEquals([
            new FileExtension(['php']),
            new FileRegex(Regex::PASCAL_CASE),
        ], $values[GuidelinePreset::SCOPES]['*'][Scope::RULES]);
    }

    public function test_it_parse_guideline_and_merge_scopes_empty(): void
    {
        $guideline = [
            GuidelinePreset::EXTENDS => [
                GuidelinePreset::SCOPES => [
                    '*' => [
                        Scope::RULES => [
                            new FileExtension(['php', 'js']),
                            new FileRegex(Regex::PASCAL_CASE),
                        ],
                    ],
                ],
            ],

            GuidelinePreset::SCOPES => [
                '*' => [],
            ],
        ];

        $values = $this->guidelineParser()->parse($guideline);

        self::assertCount(1, $values[GuidelinePreset::SCOPES]);
        self::assertEquals([
            new FileExtension(['php', 'js']),
            new FileRegex(Regex::PASCAL_CASE),
        ], $values[GuidelinePreset::SCOPES]['*'][Scope::RULES]);
    }

    public function test_it_parse_guideline_and_merge_paths(): void
    {
        $guideline = [
            GuidelinePreset::EXTENDS => [
                GuidelinePreset::SCOPES => [
                    '*' => [
                        Scope::PATHS => [
                            'tests/stubs/1',
                        ],
                    ],
                ],
            ],

            GuidelinePreset::SCOPES => [
                '*' => [
                    Scope::PATHS => [
                        'tests/stubs/2',
                    ],
                ],
            ],
        ];

        $values = $this->guidelineParser()->parse($guideline);

        self::assertEquals([
            'tests/stubs/1',
            'tests/stubs/2',
        ], $values[GuidelinePreset::SCOPES]['*'][Scope::PATHS]);
    }

    public function test_it_parse_guideline_and_merge_paths_empty(): void
    {
        $guideline = [
            GuidelinePreset::EXTENDS => [
                GuidelinePreset::SCOPES => [
                    '*' => [
                        Scope::PATHS => [
                            'tests/stubs',
                        ],
                    ],
                ],
            ],

            GuidelinePreset::SCOPES => [
                '*' => [],
            ],
        ];

        $values = $this->guidelineParser()->parse($guideline);

        self::assertEquals(['tests/stubs'], $values[GuidelinePreset::SCOPES]['*'][Scope::PATHS]);
    }

    public function test_it_parse_guideline_and_merge_paths_unique(): void
    {
        $guideline = [
            GuidelinePreset::EXTENDS => [
                GuidelinePreset::SCOPES => [
                    '*' => [
                        Scope::PATHS => [
                            'tests/stubs',
                        ],
                    ],
                ],
            ],

            GuidelinePreset::SCOPES => [
                '*' => [
                    Scope::PATHS => [
                        'tests/stubs',
                    ],
                ],
            ],
        ];

        $values = $this->guidelineParser()->parse($guideline);

        self::assertEquals(['tests/stubs'], $values[GuidelinePreset::SCOPES]['*'][Scope::PATHS]);
    }

    public function test_it_parse_guideline_and_merge_excludes(): void
    {
        $guideline = [
            GuidelinePreset::EXTENDS => [
                GuidelinePreset::SCOPES => [
                    '*' => [
                        Scope::EXCLUDES => [
                            'tests/stubs/1',
                        ],
                    ],
                ],
            ],

            GuidelinePreset::SCOPES => [
                '*' => [
                    Scope::EXCLUDES => [
                        'tests/stubs/2',
                    ],
                ],
            ],
        ];

        $values = $this->guidelineParser()->parse($guideline);

        self::assertEquals([
            'tests/stubs/1',
            'tests/stubs/2',
        ], $values[GuidelinePreset::SCOPES]['*'][Scope::EXCLUDES]);
    }

    public function test_it_parse_guideline_and_merge_excludes_empty(): void
    {
        $guideline = [
            GuidelinePreset::EXTENDS => [
                GuidelinePreset::SCOPES => [
                    '*' => [
                        Scope::EXCLUDES => [
                            'tests/stubs',
                        ],
                    ],
                ],
            ],

            GuidelinePreset::SCOPES => [
                '*' => [],
            ],
        ];

        $values = $this->guidelineParser()->parse($guideline);

        self::assertEquals(['tests/stubs'], $values[GuidelinePreset::SCOPES]['*'][Scope::EXCLUDES]);
    }

    public function test_it_parse_guideline_and_merge_excludes_unique(): void
    {
        $guideline = [
            GuidelinePreset::EXTENDS => [
                GuidelinePreset::SCOPES => [
                    '*' => [
                        Scope::EXCLUDES => [
                            'tests/stubs',
                        ],
                    ],
                ],
            ],

            GuidelinePreset::SCOPES => [
                '*' => [
                    Scope::EXCLUDES => [
                        'tests/stubs',
                    ],
                ],
            ],
        ];

        $values = $this->guidelineParser()->parse($guideline);

        self::assertEquals(['tests/stubs'], $values[GuidelinePreset::SCOPES]['*'][Scope::EXCLUDES]);
    }
}
