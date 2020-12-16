<?php


namespace Snippets\ORM\Entity;


use Bitrix\Main\ORM\Objectify\Collection;


class BookCollection {
    private $books;

    public function __construct() {
        $this->books = array();
    }

    public function getBooks(): array {
        return $this->books;
    }

    public function withoutBook(Book $book): BookCollection {
        $collection = clone $this;
        foreach ($collection->books as $index => $item) {
            if ($item->getId() === $book->getId()) {
                unset($collection->books[$index]);
            }
        }

        return $collection;
    }

    public function withBook(Book $book): BookCollection {
        $collection = clone $this;
        foreach ($collection->books as $index => $item) {
            if ($item->getId() === $book->getId()) {
                $collection->books[$index] = $item;
                return $collection;
            }
        }

        $collection->books[] = $book;
        return $collection;
    }
}