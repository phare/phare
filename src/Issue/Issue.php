<?php

namespace NicolasBeauvais\Warden\Issue;

use NicolasBeauvais\Warden\Rule\Rule;
use NicolasBeauvais\Warden\Scope\Scope;

class Issue
{
    private Rule $rule;

    private Scope $scope;

    private string $message;

    public function __construct(
        Rule $rule,
        Scope $scope,
        string $message
    ) {
        $this->rule = $rule;
        $this->scope = $scope;
        $this->message = $message;
    }

    public function getRule(): Rule
    {
        return $this->rule;
    }

    public function getScope(): Scope
    {
        return $this->scope;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
