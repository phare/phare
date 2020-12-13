<?php

namespace Phare\Assertion;

use Phare\File\File;
use Phare\Rule\Rule;

class Assertion
{
    private string $scope;

    private File $file;

    private Rule $rule;

    private bool $success = true;

    public function __construct(string $scope, File $file, Rule $rule)
    {
        $this->scope = $scope;
        $this->file = $file;
        $this->rule = $rule;
    }

    public function perform(bool $shouldFix = true): self
    {
        if ($this->rule->assert($this->file)) {
            return $this;
        }

        if ($shouldFix && $this->rule->fixable()) {
            $this->rule->fix();
        }

        $this->success = false;

        return $this;
    }

    public function successful(): bool
    {
        return $this->success;
    }
}
