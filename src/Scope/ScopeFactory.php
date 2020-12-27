<?php

namespace Phare\Scope;

use Phare\Exception\ScopeDirectoryNotFoundException;
use Phare\Preset\Scope as ScopePreset;
use Symfony\Component\Finder\Exception\DirectoryNotFoundException;
use Symfony\Component\Finder\Finder;

class ScopeFactory
{
    private ScopeValidator $scopeValidator;

    private ScopeParser $scopeParser;

    public function __construct(ScopeValidator $scopeValidator, ScopeParser $scopeParser)
    {
        $this->scopeValidator = $scopeValidator;
        $this->scopeParser = $scopeParser;
    }

    public function make(string $name, array $values): Scope
    {
        $this->scopeValidator->validate($values);

        $values = $this->scopeParser->parse($values);

        $scope = new Scope(
            $name,
            $values[ScopePreset::PATHS],
            $values[ScopePreset::EXCLUDES],
            $values[ScopePreset::RULES]
        );

        try {
            $finder = (new Finder())
                ->ignoreUnreadableDirs()
                ->exclude($scope->getExcludes())
                ->files()
                ->in($scope->getPaths());
        } catch (DirectoryNotFoundException $exception) {
            throw new ScopeDirectoryNotFoundException($exception->getMessage());
        }

        $scope->setFinder($finder);

        return $scope;
    }
}
