<?php

declare(strict_types=1);

namespace App\Catalog\Domain;

final class BookInstance
{
    public function __construct(
        private BookInstanceId $id,
        private string $isbn,
    ) {
    }

    public function getId(): BookInstanceId
    {
        return $this->id;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }
}
