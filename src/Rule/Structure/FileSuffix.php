<?php

namespace NicolasBeauvais\Warden\Rule\Structure;

use NicolasBeauvais\Warden\Issue\IssueCollection;
use NicolasBeauvais\Warden\Rule\Rule;

class FileSuffix extends Rule
{
    public function __construct(string $suffix)
    {
    }

    public function handle(): IssueCollection
    {
        return new IssueCollection();
    }
}
