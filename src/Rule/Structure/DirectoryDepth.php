<?php

namespace NicolasBeauvais\Warden\Rule\Structure;

use NicolasBeauvais\Warden\File\FileCollection;
use NicolasBeauvais\Warden\Issue\IssueCollection;
use NicolasBeauvais\Warden\Rule\Rule;

class DirectoryDepth extends Rule
{
    public string $type = self::TYPE_FILTER;

    public function __construct(int $min = null, int $max = null)
    {
    }

    public function handle(FileCollection $files): IssueCollection
    {
        return new IssueCollection;
    }
}
