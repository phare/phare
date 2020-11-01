<?php

namespace NicolasBeauvais\Warden\Rule;

use NicolasBeauvais\Warden\Issue\IssueCollection;

abstract class Rule
{
    abstract public function handle(): IssueCollection;
}
