<?php

use NicolasBeauvais\Warden\Preset\CodeSniffer;
use NicolasBeauvais\Warden\Preset\Scope;
use NicolasBeauvais\Warden\Rule\CodeSniffer\CodeSnifferSettings;
use NicolasBeauvais\Warden\Rule\Structure\FileExtension;

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
