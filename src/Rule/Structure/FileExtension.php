<?php

namespace NicolasBeauvais\Warden\Rule\Structure;

use NicolasBeauvais\Warden\File\FileCollection;
use NicolasBeauvais\Warden\Issue\IssueCollection;
use NicolasBeauvais\Warden\Rule\Rule;

class FileExtension extends Rule
{
    public string $type = self::TYPE_FILTER;

    public function __construct($extension)
    {
    }

    public function handle(FileCollection $files): IssueCollection
    {
        return new IssueCollection;
    }
}
