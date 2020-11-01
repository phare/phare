<?php

namespace NicolasBeauvais\Warden\Rule\CodeSniffer;

use NicolasBeauvais\Warden\Issue\IssueCollection;
use NicolasBeauvais\Warden\Preset\CodeSniffer;
use NicolasBeauvais\Warden\Rule\Rule;

class CodeSnifferSettings extends Rule
{
    public string $standard = CodeSniffer::STANDARD_PSR12;

    public int $errorSeverity = 5;

    public int $warningSeverity = 5;

    public array $extensions = ['php'];

    public array $excludes = [];

    public function __construct()
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

    public function handle(): IssueCollection
    {
        return new IssueCollection();
    }
}
