<?php

namespace NicolasBeauvais\Warden\Rule\PHPStan;

use NicolasBeauvais\Warden\File\FileCollection;
use NicolasBeauvais\Warden\Issue\IssueCollection;
use NicolasBeauvais\Warden\Rule\Rule;

class PHPStanRuleLevel extends Rule
{
    public string $type = self::TYPE_LINTER;

    public function __construct(int $level)
    {
    }

    public function handle(FileCollection $files): IssueCollection
    {
        return new IssueCollection;
    }
}
