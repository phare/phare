<?php

namespace NicolasBeauvais\Warden\Rule\Structure;

use NicolasBeauvais\Warden\Issue\IssueCollection;
use NicolasBeauvais\Warden\Rule\Rule;
use NicolasBeauvais\Warden\Scope\Scope;

class DirectoryDepth extends Rule
{
    public string $type = self::TYPE_FILTER;

    public function __construct(int $min = null, int $max = null)
    {
    }

    public function handle(Scope $scope): void
    {
    }
}
