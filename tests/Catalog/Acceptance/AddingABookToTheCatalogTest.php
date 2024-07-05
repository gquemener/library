<?php

declare(strict_types=1);

namespace App\Tests\Catalog\Acceptance;

use App\Catalog\Application\AddBook;
use App\Catalog\Infrastructure\BookRepositoryUsingMemory;
use PHPUnit\Framework\Attributes\Test;
use App\Catalog\Domain\Book;
use App\Catalog\Application\EventDispatcherInterface;
use App\Catalog\Application\CommandBusInterface;
use App\Catalog\Domain\BookRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class AddingABookToTheCatalogTest extends KernelTestCase
{
    private const DDD_ISBN_STR = "0321125215";

    #[Test]
    public function successfully_add_a_book_to_the_catalog(): void
    {
        $this->commandBus()->dispatch(new AddBook(self::DDD_ISBN_STR, 'DDD', 'Eric Evans'));

        $book = $this->bookRepository()->getSavedBook();
        $this->assertNotNull($book);
        $this->assertEquals(self::DDD_ISBN_STR, $book->getId());
        $this->assertEquals('DDD', $book->getTitle());
        $this->assertEquals('Eric Evans', $book->getAuthor());
    }

    private function commandBus(): CommandBusInterface
    {
        /** @var CommandBusInterface */
        return self::getContainer()->get('test_alias.service.command_bus');
    }

    private function bookRepository(): BookRepositoryUsingMemory
    {
        /** @var BookRepositoryUsingMemory */
        return self::getContainer()->get(BookRepositoryUsingMemory::class);
    }
}
