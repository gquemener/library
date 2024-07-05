<?php

declare(strict_types=1);

namespace App\Catalog\Infrastructure;

use App\Catalog\Application\Command;
use App\Catalog\Application\CommandBusInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final readonly class CommandBusUsingSymfonyMessenger implements CommandBusInterface
{
    public function __construct(
        private MessageBusInterface $commandBus,
    ) {
    }

    public function dispatch(Command $command): void
    {
        $this->commandBus->dispatch($command);
    }
}
