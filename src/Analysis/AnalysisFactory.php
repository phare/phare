<?php

namespace NicolasBeauvais\Warden\Analysis;

use NicolasBeauvais\Warden\Guideline\Guideline;
use NicolasBeauvais\Warden\Report\Report;

class AnalysisFactory
{
    public static function make(Guideline $guideline, Report $report): Analysis
    {
        $analysis = new Analysis($guideline);

        $analysis->execute($report);

        return $analysis;
    }
}
