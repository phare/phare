<?php

namespace Phare\Rule;

use Phare\Exception\RuleArgumentException;
use Phare\Exception\RuleIsNotFixable;
use Phare\File\File;
use Phare\Fixer\Fixer;

class FileExtension extends Rule
{
    private array $extensions;

    public function __construct(array $extensions)
    {
        if (empty($extensions)) {
            throw new RuleArgumentException('The FileExtension rule does not accept an empty array as argument.');
        }

        $this->extensions = $extensions;
    }

    public function errorMessage(): string
    {
        return 'File extension should be one of: ' . implode(', ', $this->extensions);
    }

    public function assert(File $file): bool
    {
        return in_array($file->getExtension(), $this->extensions, true);
    }

    public function fixable(): bool
    {
        return false;
    }

    public function fix(Fixer $fixer, File $file): void
    {
        throw new RuleIsNotFixable('The FileExtension rule is not fixable.');
    }
}
