<?php

declare(strict_types=1);

namespace App\Catalog\Application;

use App\Catalog\Domain\BookInstance;
use App\Catalog\Domain\BookInstanceRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class AddBookInstanceHandler
{
    public function __construct(
        private BookInstanceRepositoryInterface $bookInstanceRepository,
    ) {
    }

    public function __invoke(AddBookInstance $command): void
    {
        $bookInstance = new BookInstance(
            $command->id,
            $command->isbn,
        );
        $this->bookInstanceRepository->save($bookInstance);
    }
}
