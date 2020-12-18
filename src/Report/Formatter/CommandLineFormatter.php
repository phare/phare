<?php

namespace Phare\Report\Formatter;

use Phare\Assertion\Assertion;

class CommandLineFormatter extends Formatter
{
    public function output(array $assertions): string
    {
        $output = [];

        foreach ($this->groupAssertionsByFile($assertions) as $file => $fileAssertions) {
            $this->outputFileName($output, $file, $fileAssertions);

            foreach ($fileAssertions as $assertion) {
                $this->outputAssertion($output, $assertion);
            }

            $output[] = '';
        }

        return implode(PHP_EOL, $output) . PHP_EOL;
    }

    private function outputFileName(array &$output, string $file, array $assertions): void
    {
        $output[] = '<fg=yellow>[' . count($assertions) . '] ' . $file . '</>';
        $output[] = '===================';
    }

    private function outputAssertion(array &$output, Assertion $assertion): void
    {
        $message = $assertion->failed() ? $assertion->getRule()->errorMessage() : '<fg=yellow>Fixed</>';
        $output[] = $assertion->getScope() . '::' . $assertion->getRule()->class() . ' > ' . $message;
    }
}
