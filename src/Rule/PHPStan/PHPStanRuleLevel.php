<?php

namespace NicolasBeauvais\Warden\Rule\PHPStan;

use NicolasBeauvais\Warden\Issue\IssueCollection;
use NicolasBeauvais\Warden\Rule\Rule;

class PHPStanRuleLevel extends Rule
{
    public function __construct(int $level)
    {
    }

    public function handle(): IssueCollection
    {
        return new IssueCollection();
    }
}
