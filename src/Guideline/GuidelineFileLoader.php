<?php

namespace Phare\Guideline;

use Phare\Kernel;

class GuidelineFileLoader
{
    public static function load(string $filePath = null): array
    {
        $guidelineFilePath = $filePath ?? Kernel::getProjectRoot() . '/phare.php';

        // If not specific guideline is set, we load the default Phare guideline
        if (!file_exists($guidelineFilePath)) {
            return require __DIR__ . '/preset/default.php';
        }

        return require $guidelineFilePath;
    }
}
