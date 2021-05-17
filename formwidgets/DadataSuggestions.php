<?php namespace GromIT\DadataWidgets\FormWidgets;

use Backend\Classes\FormWidgetBase;
use GromIT\DadataWidgets\Models\Settings;

/**
 * DadataSuggestions Form Widget
 */
class DadataSuggestions extends FormWidgetBase
{

    const SUGGESTIONS_TYPES = [
        'company' => 'party',
        'address' => 'address',
        'bank'    => 'bank',
        'fio'     => 'fio',
        'email'   => 'email',
    ];

    public $suggestion = '';
    public $map = null;
    public $relation = true;

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
            'relation',
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
        $this->vars['relation'] = $this->relation;

        if ($this->map) {
            $modelShortName = (new \ReflectionClass($this->model))->getShortName();
            $mapWithModel = [];
            foreach ($this->map as $field => $value) {
                $mapWithModel[$modelShortName . '[' . $field . ']'] = $value;
            }
            $this->vars['map'] = $mapWithModel;
        }

        if (!in_array($this->suggestion, array_keys(self::SUGGESTIONS_TYPES)))
            throw new \Exception('Не указан тип подсказки, возможные значения: '
                . implode(', ', array_keys(self::SUGGESTIONS_TYPES)));

        $token = Settings::get('token');

        if (empty($token))
            throw new \Exception('Не заполен token для сервиса Dadata');

        $this->vars['suggestion'] = self::SUGGESTIONS_TYPES[$this->suggestion];
        $this->vars['dadataToken'] = $token;
        $this->vars['dadataUrl'] = 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/' . self::SUGGESTIONS_TYPES[$this->suggestion];

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
