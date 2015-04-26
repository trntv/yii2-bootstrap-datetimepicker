<?php

namespace trntv\yii\datetimepicker;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class MomentAsset extends AssetBundle
{
    public $sourcePath = '@bower/moment';

    public $js = [
        'min/moment-with-langs.min.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
