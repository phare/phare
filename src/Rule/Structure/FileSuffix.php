<?php

namespace Phare\Rule\Structure;

use Phare\Issue\IssueCollection;
use Phare\Rule\Rule;
use Phare\Scope\Scope;

class FileSuffix extends Rule
{
    protected string $type = self::TYPE_FILTER;

    public function __construct(string $suffix)
    {
    }

    public function handle(Scope $scope): void
    {
    }
}
