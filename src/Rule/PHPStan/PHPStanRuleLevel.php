<?php

namespace Phare\Rule\PHPStan;

use Phare\File\FileCollection;
use Phare\Issue\IssueCollection;
use Phare\Rule\Rule;
use Phare\Scope\Scope;

class PHPStanRuleLevel extends Rule
{
    protected string $type = self::TYPE_LINTER;

    public function __construct(int $level)
    {
    }

    public function handle(Scope $scope): void
    {
    }
}
