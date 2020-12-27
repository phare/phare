<?php

namespace Phare\Guideline;

use Phare\Kernel;

class GuidelineFileLoader
{
    public function load(string $filePath): array
    {
        $guidelineFilePath = Kernel::getProjectRoot() . $filePath;

        // If not specific guideline is set, we load the default Phare guideline
        if (!file_exists($guidelineFilePath)) {
            return require __DIR__ . '/preset/default.php';
        }

        return require $guidelineFilePath;
    }
}
