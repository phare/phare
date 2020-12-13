<?php

namespace Stub\Domain\Units\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class UnitQueryBuilder extends Builder
{
    public function whereActive(): self
    {
        return $this->where('active', 1);
    }
}
