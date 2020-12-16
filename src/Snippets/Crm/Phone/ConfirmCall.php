<?php


namespace Snippets\Crm\Phone;


use Bitrix\Main\Config\Option;
use Bitrix\Main\Loader;
use CCrmCallToUrl;
use Exception;
use RuntimeException;


class ConfirmCall {
    public static function enable() {
        try {
            Loader::includeModule('crm');

            Option::set('crm', 'callto_frmt', CCrmCallToUrl::Custom);
            Option::set(
                    'crm',
                    'callto_custom_settings',
                    serialize(array(
                            'URL_TEMPLATES' => 'callto:[phone]',
                            'CLICK_HANDLER' =>
                                    '(function(event) {
                                        confirm("Are you sure?") || event.preventDefault();
                                    })(event);'
                    ))
            );
        } catch (Exception $exception) {
            throw new RuntimeException('Failed to enable call confirmation.', 0, $exception);
        }
    }

    public static function disable() {
        try {
            Loader::includeModule('crm');

            Option::set('crm', 'callto_frmt', CCrmCallToUrl::Undefined);
            Option::set('crm', 'callto_custom_settings', '');
        } catch (Exception $exception) {
            throw new RuntimeException('Failed to disable call confirmation.', 0, $exception);
        }
    }
}
