<?php
namespace trntv\yii\datetimepicker;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

/**
 * Class DatetimepickerWidget
 * @package yii2-bootstrap-datetimepicker
 */
class DatetimepickerWidget extends InputWidget
{
    /**
     * @var array
     */
    public $clientOptions = [];
    /**
     * @var string
     */
    public $phpDatetimeFormat = 'dd.MM.yyyy, HH:mm';
    /**
     * @var
     */
    public $momentDatetimeFormat;

    /**
     * @var array
     */
    protected $phpMomentMapping = [
        "yyyy-MM-dd'T'HH:mm:ssZZZZZ" => 'YYYY-MM-DDTHH:mm:ssZZ', // 2014-05-14T13:55:01+02:00
        "yyyy-MM-dd"                 => 'YYYY-MM-DD',            // 2014-05-14
        "dd.MM.yyyy, HH:mm"          => 'DD.MM.YYYY, HH:mm',     // 14.05.2014, 13:55, German format without seconds
        "dd.MM.yyyy, HH:mm:ss"       => 'DD.MM.YYYY, HH:mm:ss',  // 14.05.2014, 13:55:01, German format with seconds
        "dd/MM/yyyy"                 => 'DD/MM/YYYY',            // 14/05/2014, British ascending format
        "dd/MM/yyyy HH:mm"           => 'DD/MM/YYYY HH:mm',      // 14/05/2014 13:55, British ascending format with time
        "EE, dd/MM/yyyy HH:mm"       => 'ddd, DD/MM/YYYY HH:mm', // Wed, 14/05/2014 13:55, includes day of week in British format
    ];

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        parent::init();
        $value = $this->hasModel() ? Html::getAttributeValue($this->model, $this->attribute) : $this->value;
        $this->momentDatetimeFormat = $this->momentDatetimeFormat ?: ArrayHelper::getValue(
            $this->phpMomentMapping,
            $this->phpDatetimeFormat
        );
        if (!$this->momentDatetimeFormat) {
            throw new InvalidConfigException('Please set momentjs datetime format');
        }
        // Init default clientOptions
        $this->clientOptions = ArrayHelper::merge([
            'useCurrent' => true,
            'locale' => substr(\Yii::$app->language, 0, 2),
            'format' => $this->momentDatetimeFormat,
        ], $this->clientOptions);

        // Init default options
        $this->options = ArrayHelper::merge([
            'class' => 'form-control',
        ], $this->options);

        if ($value !== null) {
            $this->options['value'] = array_key_exists('value', $this->options)
                ? $this->options['value']
                : \Yii::$app->formatter->asDatetime($value, $this->phpDatetimeFormat);
        }
        DatetimepickerAsset::register($this->getView());
        $clientOptions = Json::encode($this->clientOptions);
        $this->view->registerJs("$('#{$this->options['id']}').datetimepicker({$clientOptions})");
    }

    /**
     * @return string
     */
    public function run()
    {
        echo Html::beginTag('div', ['style' => 'position: relative']);
        if ($this->hasModel()) {
            echo Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textInput($this->name, $this->value, $this->options);
        }
        echo Html::endTag('div');
    }
}
