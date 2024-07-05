<?php

declare(strict_types=1);

namespace App\Catalog\Application;

final readonly class AddBook implements Command
{
    public function __construct(
        public string $isbn,
        public string $title,
        public string $author
    ) {
    }

}
