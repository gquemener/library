<?php

declare(strict_types=1);

namespace App\Catalog\Domain;

interface BookRepositoryInterface
{
    public function save(Book $book): void;
}
