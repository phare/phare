<?php

namespace NicolasBeauvais\Warden\Analysis;

use NicolasBeauvais\Warden\Guideline\Guideline;

class AnalysisFactory
{
    public static function make(Guideline $guideline): Analysis
    {
        $analysis = new Analysis($guideline);

        $analysis->execute();

        return $analysis;
    }
}
