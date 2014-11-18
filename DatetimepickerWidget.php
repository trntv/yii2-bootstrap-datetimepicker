<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 4:38 PM
 */

namespace trntv\yii\datetimepicker;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\FormatConverter;
use yii\helpers\Html;
use yii\widgets\InputWidget;

/**
 * Class DatetimepickerWidget
 * @package common\components\widgets\datetimepicker
 */
class DatetimepickerWidget extends InputWidget{
    /**
     * @var array
     */
    public $clientOptions = [];
    public $phpDatetimeFormat = 'dd.MM.yyyy, HH:mm';
    public $momentDatetimeFormat;

    protected $_phpMomentMapping = array(
        "yyyy-MM-dd'T'HH:mm:ssZZZZZ" => 'YYYY-MM-DDTHH:mm:ssZZ', // 2014-05-14T13:55:01+02:00
        "yyyy-MM-dd"                 => 'YYYY-MM-DD',            // 2014-05-14
        "dd.MM.yyyy, HH:mm"          => 'DD.MM.YYYY, HH:mm',     // 14.05.2014, 13:55, German format without seconds
        "dd.MM.yyyy, HH:mm:ss"       => 'DD.MM.YYYY, HH:mm:ss',  // 14.05.2014, 13:55:01, German format with seconds
        "dd/MM/yyyy"                 => 'DD/MM/YYYY',            // 14/05/2014, British ascending format
        "dd/MM/yyyy HH:mm"           => 'DD/MM/YYYY HH:mm',      // 14/05/2014 13:55, British ascending format with time
        "EE, dd/MM/yyyy HH:mm"       => 'ddd, DD/MM/YYYY HH:mm', // Wed, 14/05/2014 13:55, includes day of week in British format
    );

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init(){
        parent::init();
        $value = $this->hasModel() ? Html::getAttributeValue($this->model, $this->attribute) : $this->value;
        $this->momentDatetimeFormat = $this->momentDatetimeFormat ?: ArrayHelper::getValue($this->_phpMomentMapping, $this->phpDatetimeFormat);
        if(!$this->momentDatetimeFormat){
            throw new InvalidConfigException('Please set momentjs datetime format');
        }
        // Init default clientOptions
        $this->clientOptions = ArrayHelper::merge([
            'language'=>\Yii::$app->language,
            'format'=>$this->momentDatetimeFormat
        ], $this->clientOptions);

        // Init default options
        $this->options = ArrayHelper::merge([
            'class'=>'form-control',
        ], $this->options);

        if($value !== null){
            $this->options['value'] = isset($this->options['value'])
                ? $this->options['value']
                : \Yii::$app->formatter->asDatetime($value, $this->phpDatetimeFormat);
        }
        DatetimepickerAsset::register($this->getView());
        $this->getView()->registerJs('$("#'.$this->options['id'].'").datetimepicker('.json_encode($this->clientOptions).')');
    }

    /**
     * @return string
     */
    public function run(){
        if ($this->hasModel()) {
            return Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            return Html::textInput($this->name, $this->value, $this->options);
        }
    }
}