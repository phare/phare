<?php

namespace Phare\Assertion;

use Generator;
use JetBrains\PhpStorm\Pure;
use Phare\File\File;
use Phare\Scope\Scope;

class AssertionFactory
{
    #[Pure]
    public static function make(Scope $scope): Generator
    {
        foreach ($scope->getFinder() as $file) {
            foreach ($scope->getRules() as $rule) {
                yield new Assertion($scope->getName(), new File($file), $rule);
            }
        }
    }
}
