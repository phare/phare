<?php

namespace Phare\Analysis;

use Phare\Guideline\Guideline;
use Phare\Issue\IssueCollection;
use Phare\Report\Report;
use Phare\Rule\Rule;
use Phare\Scope\Scope;

class Analysis
{
    private Guideline $guideline;

    public function __construct(Guideline $guideline)
    {
        $this->guideline = $guideline;
    }

    public function execute(Report $report): void
    {
        foreach ($this->guideline->getScopes() as $scope) {
            $this->executeScope($report, $scope);
        }
    }

    private function executeScope(Report $report, Scope $scope): void
    {
        $filterRules = $scope->getRules(Rule::TYPE_FILTER);

        $progress = $report->initialiseProgressBar(count($filterRules));

        foreach ($filterRules as $rule) {
            $rule->handle($scope);

            $progress->advance();
        }
    }

    /**
     * @return Scope[]
     */
    public function getScopes(): array
    {
        return $this->guideline->getScopes();
    }
}
