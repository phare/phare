<?php

namespace NicolasBeauvais\Warden\Analysis;

use NicolasBeauvais\Warden\Issue\IssueCollection;
use NicolasBeauvais\Warden\Guideline\Guideline;
use NicolasBeauvais\Warden\Rule\Rule;
use NicolasBeauvais\Warden\Scope\Scope;

class Analysis
{
    private Guideline $guideline;

    private IssueCollection $issueCollection;

    public function __construct(Guideline $guideline)
    {
        $this->guideline = $guideline;
        $this->issueCollection = new IssueCollection;
    }

    public function execute(): void
    {
        foreach ($this->guideline->getScopes() as $scope) {
            $this->executeScope($scope);
        }
    }

    private function executeScope(Scope $scope): void
    {
        $filterRules = $scope->getRules(Rule::TYPE_FILTER);

        foreach ($scope->getFileCollection() as $file) {
            var_dump($file, $filterRules);die;
        }
    }

    public function getIssueCollection(): IssueCollection
    {
        return $this->issueCollection;
    }
}
