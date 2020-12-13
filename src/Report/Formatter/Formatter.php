<?php

namespace Phare\Report\Formatter;

abstract class Formatter
{
    abstract public function output(): string;
}
