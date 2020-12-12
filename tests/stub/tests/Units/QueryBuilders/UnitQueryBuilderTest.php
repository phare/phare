<?php

namespace Tests\Units\QueryBuilders;

use Domain\Units\Models\Unit;
use Tests\Factories\UnitFactory;
use Tests\TestCase;

class UnitQueryBuilderTest extends TestCase
{
    /** @test */
    public function where_active()
    {
        $factory = UnitFactory::new();

        $activeUnit = $factory->active()->create();

        $inactiveUnit = $factory->inactive()->create();

        $this->assertEquals(
            1,
            Unit::query()
                ->whereActive()
                ->whereKey($activeUnit->id)
                ->count()
        );

        $this->assertEquals(
            0,
            Unit::query()
                ->whereActive()
                ->whereKey($inactiveUnit->id)
                ->count()
        );
    }
}
