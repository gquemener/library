<?php

declare(strict_types=1);

namespace App\Catalog\Infrastructure;

use App\Catalog\Domain\Book;
use App\Catalog\Domain\BookRepositoryInterface;

final class BookRepositoryUsingMemory implements BookRepositoryInterface
{
    private ?Book $book = null;

    public function save(Book $book): void
    {
        $this->book = $book;
    }

    public function getSavedBook(): ?Book
    {
        return $this->book;
    }
}
