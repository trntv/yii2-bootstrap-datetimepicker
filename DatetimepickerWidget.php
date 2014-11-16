<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 4:38 PM
 */

namespace trntv\yii\datetimepicker;

use yii\helpers\ArrayHelper;
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
    public $format = 'DD.MM.YYYY, HH:mm';

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init(){
        parent::init();
        $value = $this->hasModel() ? Html::getAttributeValue($this->model, $this->attribute) : $this->value;
        // Init default clientOptions
        $this->clientOptions = ArrayHelper::merge([
            'language'=>\Yii::$app->language,
            'format'=>$this->format
        ], $this->clientOptions);

        // Init default options
        $this->options = ArrayHelper::merge([
            'class'=>'form-control',
        ], $this->options);

        if($value !== null){
            $this->options['value'] = isset($this->options['value']) ? $this->options['value'] : \Yii::$app->formatter->asDatetime($value, $this->format);
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