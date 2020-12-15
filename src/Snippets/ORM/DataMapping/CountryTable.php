<?php


namespace Snippets\ORM\DataMapping;


use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\StringField;


class CountryTable extends DataManager {
    public static function getTableName() {
        return 'snippets_country';
    }

    public static function getMap() {
        return array(
            (new IntegerField('ID'))->configureAutocomplete(true)->configurePrimary(true),
            (new StringField('NAME'))->configureRequired(true),
            (new StringField('COLOR_CODE'))->configureRequired(true)->configureSize(6),
            (new StringField('CODE'))->configureRequired(true)->configureSize(2)
        );
    }
}