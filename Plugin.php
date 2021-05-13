<?php namespace GromIT\DadataWidgets;

use Backend;
use GromIT\DadataWidgets\FormWidgets\DadataSuggestions;
use System\Classes\PluginBase;

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
            'iconSvg'     => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Gromit\Dadatawidgets\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'gromit.dadatawidgets.some_permission' => [
                'tab'   => 'dadatawidgets',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'dadatawidgets' => [
                'label'       => 'dadatawidgets',
                'url'         => Backend::url('gromit/dadatawidgets/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['gromit.dadatawidgets.*'],
                'order'       => 500,
            ],
        ];
    }

    public function registerFormWidgets()
    {
        return [
            DadataSuggestions::class => 'dadataSuggestions'
        ];
    }
}
