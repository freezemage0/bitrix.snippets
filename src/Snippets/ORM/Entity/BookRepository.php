<?php


namespace Snippets\ORM\Entity;


use Bitrix\Main\ORM\Data\Result;
use InvalidArgumentException;
use RuntimeException;


class BookRepository {
    private $factory;

    public function __construct(BookFactory $bookFactory) {
        $this->factory = $bookFactory;
    }

    public function findById(int $id): Book {
        $query = $this->factory->createQuery();
        $result = $query->setSelect(array('ID', 'NAME'))->where('ID', '=', $id)->exec();

        return Book::fromEntityObject($result->fetchObject());
    }

    public function findByName(string $name): BookCollection {
        $query = $this->factory->createQuery();
        $result = $query->setSelect(array('ID', 'NAME'))->where('NAME', '=', $name)->exec();

        $bookCollection = new BookCollection();
        while ($object = $result->fetchObject()) {
            $book = Book::fromEntityObject($object);
            $bookCollection = $bookCollection->withBook($book);
        }

        return $bookCollection;
    }

    public function add(Book $book): int {
        $entityObject = $this->factory->createEntity()->createObject();
        $entityObject->set('NAME', $book->getName());

        $addResult = $entityObject->save();
        $this->checkResult($addResult);

        return $addResult->getId();
    }

    public function update(Book $book): void {
        $object = $this->factory->createEntity()->createObject();
        $object->set('ID', $book->getId());
        $object->set('NAME', $book->getName());

        $result = $object->save();
        $this->checkResult($result);
    }

    public function delete(Book $book): void {
        $object = $this->factory->createEntity()->createObject();
        $object->set('ID', $book->getId());

        $deleteResult = $object->delete();
        $this->checkResult($deleteResult);
    }

    private function checkResult(Result $result): void {
        if (!$result->isSuccess()) {
            $errorMessage = implode(', ', $result->getErrorMessages());
            throw new RuntimeException($errorMessage);
        }
    }
}