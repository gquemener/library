<?php

declare(strict_types=1);

namespace App\Catalog\Domain;

final class Book
{
    public function __construct(
        private string $id,
        private string $title,
        private string $author,
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }
}
