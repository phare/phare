<?php

namespace Tests\Invoices\Collections;

use Domain\Invoices\Collections\InvoiceLineCollection;
use Tests\Factories\InvoiceLineFactory;
use Tests\TestCase;

class InvoiceLineCollectionTest extends TestCase
{
    /** @test */
    public function only_negative_lines()
    {
        $factory = InvoiceLineFactory::new();

        $negativeLine = $factory->withItemPrice(-1_00)->create();

        $collection = new InvoiceLineCollection([
            $negativeLine,
            $factory->withItemPrice(1_00)->create(),
        ]);

        $this->assertCount(1, $collection->onlyNegatives());
        $this->assertTrue($negativeLine->is($collection->onlyNegatives()->first()));
    }
}
