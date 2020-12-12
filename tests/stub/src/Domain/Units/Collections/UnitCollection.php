<?php

namespace Stub\Domain\Units\Collections;

use Illuminate\Database\Eloquent\Collection;
use Spatie\Period\Period;

class UnitCollection extends Collection
{
    public function onlyActive(): self
    {
        return $this;
    }

    public function whereType(string $type): self
    {
        return $this;
    }

    public function availableInPeriod(Period $period): self
    {
        return $this;
    }

    public function sortByPriority(): self
    {
        return $this;
    }
}
