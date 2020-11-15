<?php

namespace NicolasBeauvais\Warden\Rule\PHPStan;

use NicolasBeauvais\Warden\File\FileCollection;
use NicolasBeauvais\Warden\Issue\IssueCollection;
use NicolasBeauvais\Warden\Rule\Rule;
use NicolasBeauvais\Warden\Scope\Scope;

class PHPStanRuleLevel extends Rule
{
    public string $type = self::TYPE_LINTER;

    public function __construct(int $level)
    {
    }

    public function handle(Scope $scope): void
    {
    }
}
