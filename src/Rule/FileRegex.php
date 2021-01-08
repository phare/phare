<?php

namespace Phare\Rule;

use Phare\Exception\RuleIsNotFixable;
use Phare\File\File;
use Phare\Fixer\Fixer;
use Phare\Preset\Regex;
use Symfony\Component\String\UnicodeString;

class FileRegex extends Rule
{
    private array $fixableRegex = [
        Regex::PASCAL_CASE,
        Regex::CAMEL_CASE,
        Regex::SNAKE_CASE,
    ];

    private string $regex;

    public function __construct(string $regex)
    {
        $this->regex = $regex;
    }

    public function errorMessage(): string
    {
        return "File name should respect regular expression {$this->regex}";
    }

    public function assert(File $file): bool
    {
        return preg_match($this->regex, $file->getFilenameWithoutExtension()) === 1;
    }

    public function fixable(): bool
    {
        return in_array($this->regex, $this->fixableRegex, true);
    }

    public function fix(Fixer $fixer, File $file): void
    {
        if (!$this->fixable()) {
            throw new RuleIsNotFixable('The FileRegex rule is not fixable for the provided arguments.');
        }

        $fileName = new UnicodeString($file->getFilenameWithoutExtension());

        // @TODO: replace with match
        switch ($this->regex) {
            case Regex::PASCAL_CASE:
                $fileName = $fileName->camel()->title();
                break;
            case Regex::CAMEL_CASE:
                $fileName = $fileName->camel();
                break;
            case Regex::SNAKE_CASE:
                $fileName = $fileName->snake();
                break;
            default:
                return;
        }

        $fixer->file()->rename(
            $file,
            $file->getPath() . "/$fileName." . $file->getExtension()
        );
    }
}
