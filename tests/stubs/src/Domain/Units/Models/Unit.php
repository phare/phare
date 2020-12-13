<?php

namespace Stub\Domain\Units\Models;

use Stub\Domain\Units\Collections\UnitCollection;
use Stub\Domain\Units\QueryBuilders\UnitQueryBuilder;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $casts = [
        'active' => 'boolean',
    ];

    public function newCollection(array $models = []): UnitCollection
    {
        return new UnitCollection($models);
    }

    public function newEloquentBuilder($query): UnitQueryBuilder
    {
        return new UnitQueryBuilder($query);
    }
}
