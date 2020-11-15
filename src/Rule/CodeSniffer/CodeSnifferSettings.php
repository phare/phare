<?php

namespace NicolasBeauvais\Warden\Rule\CodeSniffer;

use NicolasBeauvais\Warden\File\FileCollection;
use NicolasBeauvais\Warden\Issue\IssueCollection;
use NicolasBeauvais\Warden\Preset\CodeSniffer;
use NicolasBeauvais\Warden\Rule\Rule;
use NicolasBeauvais\Warden\Scope\Scope;

class CodeSnifferSettings extends Rule
{
    public string $type = self::TYPE_LINTER;

    public string $standard = CodeSniffer::STANDARD_PSR12;

    public int $errorSeverity = 5;

    public int $warningSeverity = 5;

    public array $extensions = ['php'];

    public array $excludes = [];

    public function handle(Scope $scope): void
    {
    }

    public function standard(string $standard) : self
    {
        return $this;
    }

    public function errorSeverity(int $errorSeverity) : self
    {
        return $this;
    }

    public function warningSeverity(int $warningSeverity) : self
    {
        return $this;
    }

    public function extensions(array $extensions) : self
    {
        return $this;
    }

    public function excludes(array $excludes) : self
    {
        return $this;
    }
}
