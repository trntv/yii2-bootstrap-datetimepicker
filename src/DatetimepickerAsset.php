<?php
namespace trntv\yii\datetimepicker;

use yii\web\AssetBundle;

class DatetimepickerAsset extends AssetBundle
{
    public $sourcePath = '@bower/eonasdan-bootstrap-datetimepicker';

    public $css = [
        'build/css/bootstrap-datetimepicker.min.css'
    ];

    public $js = [
        'build/js/bootstrap-datetimepicker.min.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'trntv\yii\datetimepicker\MomentAsset'
    ];

}