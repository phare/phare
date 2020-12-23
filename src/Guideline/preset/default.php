<?php

use Phare\Preset\Guideline;
use Phare\Preset\Scope;
use Phare\Rule\FileExtension;

return [
    Guideline::SCOPES => [
        '*' => [
            Scope::EXCLUDES => [
                'tests',
                'vendor',
            ],

            Scope::RULES => [
                // Structure rules
                // new FileRegex(Regex::CAMEL_CASE),
                new FileExtension(['php', 'js']),
                // new DirectoryRegex(Regex::CAMEL_CASE),
                // new DirectoryDepth(1, 10),

                // PHPStan
                // new PHPStanRuleLevel(8),
            ]
        ]
    ]
];
