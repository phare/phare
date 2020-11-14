<?php

namespace NicolasBeauvais\Warden\Rule\Structure;

use NicolasBeauvais\Warden\File\FileCollection;
use NicolasBeauvais\Warden\Issue\IssueCollection;
use NicolasBeauvais\Warden\Rule\Rule;

class FileSuffix extends Rule
{
    public string $type = self::TYPE_FILTER;

    public function __construct(string $suffix)
    {
    }

    public function handle(FileCollection $files): IssueCollection
    {
        return new IssueCollection;
    }
}
