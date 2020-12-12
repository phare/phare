<?php

namespace Phare\Rules;

use Phare\Scope\Scope;
use Symfony\Component\Finder\Finder;

class RuleCollection
{
    /**
     * @var Rule[] $rules
     */
    protected array $rules;

    public function push(Rule $rule, Scope $scope, Finder $files): void
    {
        foreach ($files as $file) {
            $rule->addFiles($scope, $file);
        }

        $this->rules[spl_object_hash($rule)] = $rule;
    }

    public function getRules(): array
    {
        return $this->rules;
    }
}
