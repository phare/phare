<?php

use Phare\Preset\CodeSniffer;
use Phare\Preset\Scope;
use Phare\Rule\CodeSniffer\CodeSnifferSettings;
use Phare\Rule\Structure\FileExtension;

return [
    'scopes' => [
        '*' => [
            Scope::RULES => [
                // Structure rules
                // new FileRegex(Regex::CAMEL_CASE),
                new FileExtension(['php', 'js']),
                // new DirectoryRegex(Regex::CAMEL_CASE),
                // new DirectoryDepth(1, 10),

                // PHP CodeSniffer
                (new CodeSnifferSettings())
                    ->standard(CodeSniffer::STANDARD_PSR12)
                    ->extensions(['php'])
                    ->excludes([
                        'Generic.PHP.LowerCaseConstant',
                        'PEAR.WhiteSpace.ScopeIndent',
                    ]),

                // PHPStan
                // new PHPStanRuleLevel(8),
            ]
        ]
    ]
];
