<?php

namespace Phare\File;

use Phare\Scope\Scope;
use Symfony\Component\Finder\SplFileInfo;

class FileFactory
{
    /**
     * @return Assertion[]
     */
    public static function make(Scope $scope, SplFileInfo $fileInfo): File
    {
        $file = new File($fileInfo);

        foreach ($scope->getRules() as $rule) {
            $file->addAssertion(new Assertion($scope->getName(), $rule));
        }

        return $file;
    }
}
