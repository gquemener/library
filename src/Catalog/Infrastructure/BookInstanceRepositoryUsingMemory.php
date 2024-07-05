<?php

declare(strict_types=1);

namespace App\Catalog\Infrastructure;

use App\Catalog\Domain\BookInstance;
use App\Catalog\Domain\BookInstanceRepositoryInterface;

final class BookInstanceRepositoryUsingMemory implements BookInstanceRepositoryInterface
{
    private ?BookInstance $bookInstance = null;

    public function save(BookInstance $bookInstance): void
    {
        $this->bookInstance = $bookInstance;
    }

    public function getSavedBookInstance(): ?BookInstance
    {
        return $this->bookInstance;
    }
}
