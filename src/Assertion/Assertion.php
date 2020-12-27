<?php

namespace Phare\Assertion;

use Phare\File\File;
use Phare\Fixer\Fixer;
use Phare\Rule\Rule;

class Assertion
{
    public const STATUS_SUCCESS = 'success';
    public const STATUS_FIXED = 'fixed';
    public const STATUS_ERROR = 'error';
    public const STATUS_NOT_PERFORMED = 'not_performed';

    private string $scope;

    private File $file;

    private Rule $rule;

    private string $status = self::STATUS_NOT_PERFORMED;

    public function __construct(string $scope, File $file, Rule $rule)
    {
        $this->scope = $scope;
        $this->file = $file;
        $this->rule = $rule;
    }

    public function perform(bool $shouldFix = true): self
    {
        $this->status = self::STATUS_ERROR;

        if ($this->rule->assert($this->file)) {
            $this->status = self::STATUS_SUCCESS;
            return $this;
        }

        if ($shouldFix && $this->rule->fixable()) {
            $this->rule->fix(new Fixer(), $this->file);
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

    public function failed(): bool
    {
        return $this->status === self::STATUS_ERROR;
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
