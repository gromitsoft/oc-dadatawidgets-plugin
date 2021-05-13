<?php namespace GromIT\DadataWidgets;

use GromIT\DadataWidgets\FormWidgets\DadataSuggestions;
use GromIT\DadataWidgets\Models\Settings;
use System\Classes\PluginBase;
use System\Classes\SettingsManager;

/**
 * DadataWidgets Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'DadataWidgets',
            'description' => 'Formwidgets working with Dadata services',
            'author'      => 'GromIT',
            'icon'        => 'octo-icon-magic-wand'
        ];
    }

    public function registerFormWidgets()
    {
        return [
            DadataSuggestions::class => 'dadataSuggestions'
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Dadata Widgets',
                'description' => 'Manage Dadata token',
                'category'    => SettingsManager::CATEGORY_SYSTEM,
                'icon'        => 'octo-icon-magic-wand',
                'class'       => Settings::class,
                'order'       => 500,
                'keywords'    => 'dadata form widgets',
            ]
        ];
    }
}
