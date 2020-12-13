<?php

namespace Phare\Preset;

class Regex
{
    public const PASCAL_CASE = '/^[A-Z][a-z]+(?:[A-Z][a-z]+)*$/';

    public const CAMEL_CASE = '/^[a-z]+(?:[A-Z][a-z]+)*$/';

    public const SNAKE_CASE = '/[a-z_]*/';
}
