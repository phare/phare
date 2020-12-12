<?php

namespace Stub\App\Console\Playbooks;

use Stub\Support\Playbooks\Playbook;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Tests\Factories\BookingFactory;

class BookingsPlaybook extends Playbook
{
    public function run(InputInterface $input, OutputInterface $output): void
    {
        BookingFactory::times(10)->create();
    }
}
