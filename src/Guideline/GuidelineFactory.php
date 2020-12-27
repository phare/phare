<?php

namespace Phare\Guideline;

use Phare\Assertion\AssertionFactory;
use Phare\Preset\Guideline as GuidelinePreset;
use Phare\Scope\ScopeFactory;

class GuidelineFactory
{
    protected GuidelineFileLoader $guidelineFileLoader;

    protected GuidelineValidator $guidelineValidator;

    protected GuidelineParser $guidelineParser;

    protected ScopeFactory $scopeFactory;

    protected AssertionFactory $assertionFactory;

    public function __construct(
        GuidelineFileLoader $guidelineFileLoader,
        GuidelineValidator $guidelineValidator,
        GuidelineParser $guidelineParser,
        ScopeFactory $scopeFactory,
        AssertionFactory $assertionFactory
    ) {
        $this->guidelineFileLoader = $guidelineFileLoader;
        $this->guidelineValidator = $guidelineValidator;
        $this->guidelineParser = $guidelineParser;
        $this->scopeFactory = $scopeFactory;
        $this->assertionFactory = $assertionFactory;
    }

    public function make(string $filePath): Guideline
    {
        $values = $this->guidelineFileLoader->load($filePath);

        $this->guidelineValidator->validate($values);

        $values = $this->guidelineParser->parse($values);

        $guideline = new Guideline();

        foreach ($values[GuidelinePreset::SCOPES] as $name => $scopeValues) {
            $scope = $this->scopeFactory->make($name, $scopeValues);

            foreach ($this->assertionFactory->make($scope) as $assertion) {
                $guideline->addAssertion($assertion);
            }
        }

        return $guideline;
    }
}
