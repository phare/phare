<?php

namespace NicolasBeauvais\Warden\Rule\Structure;

use NicolasBeauvais\Warden\Issue\IssueCollection;
use NicolasBeauvais\Warden\Rule\Rule;
use NicolasBeauvais\Warden\Scope\Scope;

class DirectoryRegex extends Rule
{
    public string $type = self::TYPE_FILTER;

    public function __construct(string $regex)
    {
    }

    public function handle(Scope $scope): void
    {
    }
}
