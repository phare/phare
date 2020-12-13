<?php

namespace Phare\Report\Formatter;

use Phare\Assertion\Assertion;

abstract class Formatter
{
    abstract public function output(array $assertions): string;

    /**
     * @param Assertion[] $assertions
     */
    protected function groupAssertionsByFile(array $assertions): array
    {
        $files = [];

        foreach ($assertions as $assertion) {
            $path = $assertion->getFile()->getWorkingPath();

            if (!isset($files[$path])) {
                $files[$path] = [];
            }

            $files[$path][] = $assertion;
        }

        return $files;
    }
}
