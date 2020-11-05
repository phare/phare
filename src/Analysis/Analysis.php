<?php

namespace NicolasBeauvais\Warden\Analysis;

use NicolasBeauvais\Warden\Guideline\Guideline;
use NicolasBeauvais\Warden\Issue\IssueCollection;
use NicolasBeauvais\Warden\Scope\Scope;

class Analysis
{
    private Guideline $guideline;

    private array $files;

    private IssueCollection $issueCollection;

    public function __construct(Guideline $guideline)
    {
        $this->guideline = $guideline;
    }

    public function pushFile(string $file, Scope $scope): void
    {
        $this->files[$file] = array_merge_recursive(
            [
                'scopes' => [$scope->getName()],
                'rules' => $scope->getRules()
            ],
            $this->files[$file] ?? []
        );
    }

    public function getFiles(): array
    {
        return $this->files;
    }

    public function getIssueCollection(): IssueCollection
    {
        return $this->issueCollection;
    }

    public function execute()
    {
        foreach ($this->getFiles() as $filePath => $file) {
            var_dump($filePath, $file);die;
        }
    }
}
