<?php

namespace Stub\Support\Playbooks;

class PlaybookDefinition
{
    public string $id;

    public Playbook $playbook;

    public int $times = 1;

    public bool $once = false;

    public static function times(string $className, int $times): PlaybookDefinition
    {
        $definition = new self($className);

        $definition->times = $times;

        return $definition;
    }

    public static function once(string $className): PlaybookDefinition
    {
        $definition = new self($className);

        $definition->once = true;

        return $definition;
    }

    public function __construct(string $className)
    {
        $this->playbook = app($className);
        $this->id = get_class($this->playbook);
    }
}
