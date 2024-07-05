<?php

declare(strict_types=1);

namespace App\Catalog\Domain;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final readonly class BookInstanceId
{
    public function __construct(
        private UuidInterface $value
    ) {
    }

    public static function generate(): self
    {
        return new self(Uuid::uuid7());
    }
}
