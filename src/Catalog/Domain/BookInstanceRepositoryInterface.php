<?php

declare(strict_types=1);

namespace App\Catalog\Domain;

interface BookInstanceRepositoryInterface
{
    public function save(BookInstance $bookInstance): void;
}
