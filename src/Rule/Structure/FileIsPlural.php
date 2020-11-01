<?php

namespace NicolasBeauvais\Warden\Rule\Structure;

use NicolasBeauvais\Warden\Issue\IssueCollection;
use NicolasBeauvais\Warden\Rule\Rule;

class FileIsPlural extends Rule
{
    public function __construct()
    {
    }

    public function handle(): IssueCollection
    {
        return new IssueCollection();
    }
}
