<?php namespace GromIT\DadataWidgets\FormWidgets;

use Backend\Classes\FormWidgetBase;

/**
 * DataContainer Form Widget
 */
class DataContainer extends FormWidgetBase
{
    /**
     * @inheritDoc
     */
    protected $defaultAlias = 'data_container';

    /**
     * @inheritDoc
     */
    public function init()
    {
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('datacontainer');
    }

    /**
     * Prepares the form widget view data
     */
    public function prepareVars()
    {
        $this->vars['field'] = $this->formField;
        $this->vars['value'] = json_encode($this->getLoadValue());
    }

    /**
     * @inheritDoc
     */
    public function loadAssets()
    {
        $this->addCss('css/datacontainer.css', 'GromIT.DadataWidgets');
        $this->addJs('js/datacontainer.js', 'GromIT.DadataWidgets');
    }

    /**
     * @inheritDoc
     */
    public function getSaveValue($value)
    {
        return $value;
    }
}
