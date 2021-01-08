<?php

namespace Phare\Rule;

use Phare\Exception\RuleIsNotFixable;
use Phare\File\File;
use Phare\Fixer\Fixer;

class DirectoryDepth extends Rule
{
    private int $min;
    private ?int $max;

    public function __construct(int $min = null, int $max = null)
    {
        $this->min = $min ?? 0;
        $this->max = $max;
    }

    public function errorMessage(): string
    {
        if ($this->max) {
            return "File directory depth should be between $this->min and $this->max";
        }

        return "File directory depth should be greater than $this->min";
    }

    public function assert(File $file): bool
    {
        $depth = substr_count($file->getWorkingPath(), DIRECTORY_SEPARATOR);

        if (!is_null($this->max) && $depth > $this->max) {
            return false;
        }

        return $depth >= $this->min;
    }

    public function fixable(): bool
    {
        return false;
    }

    public function fix(Fixer $fixer, File $file): void
    {
        throw new RuleIsNotFixable('The DirectoryDepth rule is not fixable.');
    }
}
