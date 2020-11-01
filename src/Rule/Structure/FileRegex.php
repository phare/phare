<?php

namespace NicolasBeauvais\Warden\Rule\Structure;

use NicolasBeauvais\Warden\Issue\IssueCollection;
use NicolasBeauvais\Warden\Rule\Rule;

class FileRegex extends Rule
{
    public function __construct(string $regex)
    {
    }

    public function handle(): IssueCollection
    {
        return new IssueCollection();
    }
}
