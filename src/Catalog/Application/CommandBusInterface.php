<?php

declare(strict_types=1);

namespace App\Catalog\Application;

interface CommandBusInterface
{
    public function dispatch(Command $command): void;
}
