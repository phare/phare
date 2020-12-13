<?php

namespace Phare\File;

use Symfony\Component\Finder\SplFileInfo;

class File
{
    private SplFileInfo $file;

    private array $assertions;

    public function __construct(SplFileInfo $file)
    {
        $this->file = $file;
    }

    public function getRealPath(): string
    {
        return $this->file->getRealPath();
    }

    public function getExtension(): string
    {
        return $this->file->getExtension();
    }

    public function addAssertion(Assertion $assertion): void
    {
        $this->assertions[] = $assertion;
    }

    public function mergeAssertions(array $assertions): void
    {
        $this->assertions = array_merge($this->assertions, $assertions);
    }

    public function getAssertions(): array
    {
        return $this->assertions;
    }
}
