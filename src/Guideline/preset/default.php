<?php

use Phare\Preset\Scope;
use Phare\Rules\CodeSniffer\CodeSnifferSettings;
use Phare\Rules\FileExtension;

return [
    'scopes' => [
        '*' => [
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
