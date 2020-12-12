<?php

namespace Phare\Rules;

abstract class LinterRule extends Rule
{
    protected string $type = Rule::TYPE_FILTER;
}
