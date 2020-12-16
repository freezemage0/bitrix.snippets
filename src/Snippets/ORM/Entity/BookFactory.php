<?php


namespace Snippets\ORM\Entity;


use Bitrix\Main\ORM\Entity;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Query\Query;


class BookFactory {
    public function createEntity() {
        $fields = array(
            (new IntegerField('ID'))->configurePrimary(true)->configureAutocomplete(true),
            (new StringField('NAME'))->configureSize(64)
        );
        $parameters = array(
            'table_name' => 'snippets_book',
            'uf_id' => 'SNIPPET_BOOK'
        );
        return Entity::compileEntity(Book::class, $fields, $parameters);
    }

    public function createQuery() {
        return new Query($this->createEntity());
    }
}