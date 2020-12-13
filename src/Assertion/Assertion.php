<?php

namespace Phare\Assertion;

use Phare\File\File;
use Phare\Rule\Rule;

class Assertion
{
    public const STATUS_SUCCESS = 'success';
    public const STATUS_FIXED = 'fixed';
    public const STATUS_ERROR = 'error';

    private string $scope;

    private File $file;

    private Rule $rule;

    private string $status = self::STATUS_SUCCESS;

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

        $this->status = self::STATUS_ERROR;

        if ($shouldFix && $this->rule->fixable()) {
            $this->rule->fix();
            $this->status = self::STATUS_FIXED;
        }

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function successful(): bool
    {
        return $this->status === self::STATUS_SUCCESS;
    }

    public function getFile(): File
    {
        return $this->file;
    }

    public function getScope(): string
    {
        return $this->scope;
    }

    public function getRule(): Rule
    {
        return $this->rule;
    }
}
