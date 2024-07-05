<?php

declare(strict_types=1);

namespace App\Catalog\Application;

use App\Catalog\Domain\Book;
use App\Catalog\Domain\BookRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class AddBookHandler
{
    public function __construct(
        private BookRepositoryInterface $bookRepository,
    ) {
    }

    public function __invoke(AddBook $command): void
    {
        $book = new Book(
            $command->isbn,
            $command->title,
            $command->author,
        );

        $this->bookRepository->save($book);
    }
}
