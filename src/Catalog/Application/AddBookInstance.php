<?php

declare(strict_types=1);

namespace App\Catalog\Application;

use App\Catalog\Domain\BookInstanceId;

final class AddBookInstance implements Command
{
    public function __construct(
        public BookInstanceId $id,
        public string $isbn,
    ) {
    }
}
