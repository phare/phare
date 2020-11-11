<?php

namespace NicolasBeauvais\Warden\Analysis;

use NicolasBeauvais\Warden\Guideline\Guideline;
use NicolasBeauvais\Warden\Issue\IssueCollection;
use NicolasBeauvais\Warden\Scope\Scope;
use Symfony\Component\Finder\Finder;

class Analysis
{
    private array $scopes;

    private array $rules;

    private Guideline $guideline;

    private IssueCollection $issueCollection;

    public function __construct(Guideline $guideline)
    {
        $this->guideline = $guideline;
        $this->issueCollection = new IssueCollection;
    }

    public function addFiles(Finder $files, Scope $scope): void
    {
        $this->pushScope($scope);

        foreach ($scope->getRules() as $rule) {
            $hash = spl_object_hash($rule);

            if (!isset($this->rules[$hash])) {
                $this->rules[$hash] = [
                    'instance' => $rule,
                    'files' => [],
                ];
            }

            foreach ($files as $file) {
                $this->rules[$hash]['files'][] = [
                    'scope' => $scope->getName(),
                    'file' => $file->getRealPath()
                ];
            }

            $this->incrementScopeFiles($scope->getName(), $files->count());
        }
    }

    public function pushScope(Scope $scope): void
    {
        if (!isset($this->scopes[$scope->getName()])) {
            $this->scopes[$scope->getName()] = [
                'files' => 0,
                'rules' => count($scope->getRules()),
            ];
        }
    }

    private function incrementScopeFiles(string $scope, int $value): void
    {
        $this->scopes[$scope]['files'] += $value;
    }

    public function getScopes(): array
    {
        return $this->scopes;
    }

    public function getIssueCollection(): IssueCollection
    {
        return $this->issueCollection;
    }

    public function execute(): void
    {
        foreach ($this->rules as $rule) {
            var_dump($rule['files']);die;
        }
    }
}
