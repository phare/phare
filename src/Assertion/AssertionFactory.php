<?php

namespace Phare\Assertion;

use Generator;
use Phare\Exception\FileDoesNotExistException;
use Phare\File\File;
use Phare\Scope\Scope;

class AssertionFactory
{
    public static function make(Scope $scope): Generator
    {
        foreach ($scope->getFinder() as $file) {
            $fileRealPath = $file->getRealPath();

            if (!$fileRealPath) {
                throw new FileDoesNotExistException('File does not exist: ' . $file->getPath());
            }

            $file = new File($fileRealPath);

            foreach ($scope->getRules() as $rule) {
                yield new Assertion($scope->getName(), $file, $rule);
            }
        }
    }
}
