<?php

namespace Phare\Rule\Structure;

use Phare\Issue\IssueCollection;
use Phare\Rule\Rule;
use Phare\Scope\Scope;

class DirectoryDepth extends Rule
{
    protected string $type = self::TYPE_FILTER;

    public function __construct(int $min = null, int $max = null)
    {
    }

    public function handle(Scope $scope): void
    {
    }
}
