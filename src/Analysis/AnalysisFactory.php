<?php

namespace Phare\Analysis;

use Phare\Guideline\Guideline;
use Phare\Report\Report;

class AnalysisFactory
{
    public static function make(Guideline $guideline, Report $report): Analysis
    {
        $analysis = new Analysis($guideline);

        $analysis->execute($report);

        return $analysis;
    }
}
