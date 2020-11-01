<?php

namespace NicolasBeauvais\Warden\Guideline;

use NicolasBeauvais\Warden\Issue\IssueCollection;

class GuidelineIssueCollector
{
    public static function collect(Guideline $guideline): IssueCollection
    {
        return new IssueCollection;
    }
}
