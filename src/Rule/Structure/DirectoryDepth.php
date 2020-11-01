<?php

namespace NicolasBeauvais\Warden\Rule\Structure;

use NicolasBeauvais\Warden\Issue\IssueCollection;
use NicolasBeauvais\Warden\Rule\Rule;

class DirectoryDepth extends Rule
{
    public function __construct(int $min = null, int $max = null)
    {
    }

    public function handle(): IssueCollection
    {
        return new IssueCollection();
    }
}
