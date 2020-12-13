<?php

namespace Phare\Issue;

use Phare\File\File;
use Phare\Rule\Rule;

class Issue
{
    private File $file;

    private Rule $rule;

    private string $message;

    public function __construct(
        File $file,
        Rule $rule,
        string $message
    ) {
        $this->file = $file;
        $this->rule = $rule;
        $this->message = $message;
    }

    public function getFile(): File
    {
        return $this->file;
    }

    public function getRule(): Rule
    {
        return $this->rule;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
