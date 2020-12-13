<?php

namespace Phare\Report\Formatter;

use JetBrains\PhpStorm\Pure;
use Phare\Assertion\Assertion;

class CommandLineFormatter extends Formatter
{
    #[Pure]
    public function output(array $files): string
    {
        $output = '';

        /** @var Assertion[] $assertions */
        foreach ($files as $file => $assertions) {
            $output .= '<fg=yellow>[' . count($assertions) . '] ' . $file . '</>' . PHP_EOL;
            $output .= '===================' . PHP_EOL;

            foreach ($assertions as $assertion) {
                $output .= $assertion->getScope() . '::' . $assertion->getRule()->class() . ' > ';
                $output .= $assertion->getRule()->errorMessage();
            }

            $output .= PHP_EOL . PHP_EOL;
        }

        return $output . PHP_EOL;
    }
}
