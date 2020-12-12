<?php

namespace Tests\Factories;

use Domain\Clients\Models\Client;
use Support\TestFactories\Factory;

class ClientFactory extends Factory
{
    private ?string $number = null;

    private ?string $name = null;

    private static int $currentNumber = 1;

    public static function new(): ClientFactory
    {
        return new self();
    }

    public function create(array $extra = []): Client
    {
        return Client::create(
            $extra + [
                'name' => $this->name ?? faker()->name,
                'number' => $this->number
                    ?? (function () {
                        $currentNumber = str_pad(self::$currentNumber, 3, '0', STR_PAD_LEFT);

                        $clientNumber = "CLIENT-{$currentNumber}";

                        self::$currentNumber++;

                        return $clientNumber;
                    })(),
            ]
        );
    }

    public function withNumber(string $number): self
    {
        $clone = clone $this;

        $clone->number = $number;

        return $clone;
    }
}
