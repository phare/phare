<?php

namespace NicolasBeauvais\Warden\Guideline;

use NicolasBeauvais\Warden\Kernel;

class GuidelineFileLoader
{
    public static function load(string $filePath = null): array
    {
        $guidelineFilePath = $filePath ?? Kernel::getProjectRoot() . '/warden.php';

        // If not specific guideline is set, we load the default Warden guideline
        if (!file_exists($guidelineFilePath)) {
            return require __DIR__ . '/preset/default.php';
        }

        return require $guidelineFilePath;
    }
}
