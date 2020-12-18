<?php

namespace Phare\Assertion;

use Generator;
use Phare\File\File;
use Phare\Scope\Scope;

class AssertionFactory
{
    public static function make(Scope $scope): Generator
    {
        foreach ($scope->getFinder() as $file) {
            $file = new File($file->getRealPath());

            foreach ($scope->getRules() as $rule) {
                yield new Assertion($scope->getName(), $file, $rule);
            }
        }
    }
}
