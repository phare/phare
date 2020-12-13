<?php

namespace Phare\Guideline;

use Phare\Assertion\Assertion;

class Guideline
{
    protected array $scopes;

    /**
     * @var Assertion[]
     */
    protected array $assertions;

    public function addAssertion(Assertion $assertion): void
    {
        $this->assertions[] = $assertion;
    }

    public function getAssertions(): array
    {
        return $this->assertions;
    }
}
