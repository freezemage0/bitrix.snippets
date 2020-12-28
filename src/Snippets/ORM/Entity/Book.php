<?php


namespace Snippets\ORM\Entity;


use Bitrix\Main\ORM\Objectify\EntityObject;
use InvalidArgumentException;


class Book {
    private $id;
    private $name;

    public static function fromEntityObject(EntityObject $entityObject) {
        if (!$entityObject->has('NAME')) {
            throw new InvalidArgumentException('Missing book name.');
        }

        $id = $entityObject->get('ID');
        $name = $entityObject->get('NAME');

        return new Book($id, $name);
    }

    public function __construct(?int $id, string $name) {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function withId(?int $id): Book {
        $book = clone $this;
        $book->id = $id;

        return $book;
    }

    public function getName(): string {
        return $this->name;
    }

    public function withName(string $name): Book {
        $book = clone $this;
        $book->name = $name;

        return $book;
    }
}