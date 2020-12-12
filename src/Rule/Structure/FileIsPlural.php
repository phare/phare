<?php

namespace Phare\Rule\Structure;

use Phare\Issue\IssueCollection;
use Phare\Rule\Rule;
use Phare\Scope\Scope;

class FileIsPlural extends Rule
{
    protected string $type = self::TYPE_FILTER;

    public function __construct()
    {
    }

    public function handle(Scope $scope): void
    {
    }
}
