<?php

declare(strict_types=1);

namespace App\Tests\Catalog\Acceptance;

use App\Catalog\Domain\DrivenPort\AddBook;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use App\Catalog\Infrastructure\InMemoryBookRepository;
use App\Catalog\Module;
use App\Catalog\Domain\Book;
use App\Tests\TestEventDispatcher;

final class AddingABookToTheCatalogTest extends TestCase
{
    private const DDD_ISBN_STR = "0321125215";

    #[Test]
    public function successfully_add_a_book_to_the_catalog(): void
    {
        $bookRepository = new InMemoryBookRepository();
        $eventDispatcher = new TestEventDispatcher();
        $module = new Module($bookRepository, $eventDispatcher);
        $module->addBook(new AddBook(self::DDD_ISBN_STR, 'DDD', 'Eric Evans'));

        $book = new Book();
        $book->setId(self::DDD_ISBN_STR);
        $book->setTitle('DDD');
        $book->setAuthor('Eric Evans');

        $this->assertEquals($book, $bookRepository->getSavedBook());
    }
}
