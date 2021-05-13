<?php namespace GromIT\DadataWidgets\FormWidgets;

use Backend\Classes\FormWidgetBase;
use GromIT\DadataWidgets\Models\Settings;

/**
 * DadataSuggestions Form Widget
 */
class DadataSuggestions extends FormWidgetBase
{

    public $suggestion = '';
    public $map = null;

    /**
     * @inheritDoc
     */
    protected $defaultAlias = 'dadata_suggestions';

    /**
     * @inheritDoc
     */
    public function init()
    {
        $this->fillFromConfig([
            'suggestion',
            'map',
        ]);
    }

    /**
     * @inheritDoc
     * @throws \SystemException
     */
    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('dadatasuggestions');
    }

    /**
     * Prepares the form widget view data
     * @throws \Exception
     */
    public function prepareVars()
    {
        $this->vars['name'] = $this->formField->getName();
        $this->vars['value'] = $this->getLoadValue();
        $this->vars['model'] = $this->model;

        if ($this->map) {
            $modelShortName = (new \ReflectionClass($this->model))->getShortName();
            $mapWithModel = [];
            foreach ($this->map as $field => $value) {
                $mapWithModel[$modelShortName . '[' . $field . ']'] = $value;
            }
            $this->vars['map'] = $mapWithModel;
        }

        switch ($this->suggestion) {
            case '':
                $suggestion = null;
                break;
            case 'company':
                $suggestion = 'party';
                break;
            case 'address':
                $suggestion = 'address';
                break;
            case 'bank':
                $suggestion = 'bank';
                break;
            case 'fio':
                $suggestion = 'fio';
                break;
            case 'email':
                $suggestion = 'email';
                break;
            default:
                throw new \Exception('Unexpected value');
        }

        $token = Settings::get('token');

        if (empty($token))
            throw new \Exception('Не заполен token для сервиса Dadata');

        if (empty($suggestion))
            throw new \Exception('Не указан тип подсказки suggestion');

        $this->vars['suggestion'] = $suggestion;
        $this->vars['dadataToken'] = $token;
        $this->vars['dadataUrl'] = 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/' . $suggestion;

    }

    /**
     * @inheritDoc
     */
    public function loadAssets()
    {
        $this->addCss('css/dadatasuggestions.css', 'GromIT.DadataWidgets');
        $this->addJs('js/dadatasuggestions.js', 'GromIT.DadataWidgets');
    }

    /**
     * @inheritDoc
     */
    public function getSaveValue($value)
    {
        return $value;
    }
}
