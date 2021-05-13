<?php namespace GromIT\DadataWidgets\Models;

use Model;
use System\Behaviors\SettingsModel;

/**
 * Settings Model
 */
class Settings extends Model
{
    public $implement = [
        SettingsModel::class,
    ];
    public $settingsCode = 'gromit_dadatawidgets_settings';

    public $settingsFields = [
        'fields' => [
            '_tokentitle' => [
                'label' => 'Dadata widgets settings',
                'type'  => 'section',
            ],
            'token'       => [
                'label'       => 'Dadata token',
                'commentHtml' => true,
                'comment'     => 'To use this Dadata suggestions, you must have the token. <a href="https://dadata.ru/" target="_blank">Get token here</a>..'
            ],
        ]
    ];
}
