<?php

declare(strict_types=1);

namespace App\Tests\Catalog\Acceptance;

use App\Catalog\Application\AddBook;
use App\Catalog\Application\AddBookInstance;
use App\Catalog\Infrastructure\BookRepositoryUsingMemory;
use App\Catalog\Infrastructure\BookInstanceRepositoryUsingMemory;
use PHPUnit\Framework\Attributes\Test;
use App\Catalog\Domain\Book;
use App\Catalog\Domain\BookInstanceId;
use App\Catalog\Application\CommandBusInterface;
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

    #[Test]
    public function successfully_add_a_book_instance_of_a_known_book_to_the_catalog(): void
    {
        $this->bookRepository()->save(new Book(self::DDD_ISBN_STR, 'DDD', 'Eric Evans'));

        $this->commandBus()->dispatch(new AddBookInstance($id = BookInstanceId::generate(), self::DDD_ISBN_STR));

        $bookInstance = $this->bookInstanceRepository()->getSavedBookInstance();
        $this->assertNotNull($bookInstance);
        $this->assertEquals($id, $bookInstance->getId());
        $this->assertEquals(self::DDD_ISBN_STR, $bookInstance->getIsbn());
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

    public function bookInstanceRepository(): BookInstanceRepositoryUsingMemory
    {
        /** @var BookInstanceRepositoryUsingMemory */
        return self::getContainer()->get(BookInstanceRepositoryUsingMemory::class);
    }
}
