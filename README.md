Yii2 DateTimePicker
===================
DateTime picker widget for Yii2 framework
Based on [Eonasdan/bootstrap-datetimepicker](https://github.com/Eonasdan/bootstrap-datetimepicker)

Demo
----
Since file kit is a part of [yii2-starter-kit](https://github.com/trntv/yii2-starter-kit) it's demo can be found in starter kit demo [here](http://backend.yii2-starter-kit.terentev.net/article/create).

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require trntv/yii2-bootstrap-datetimepicker
```

or add

```
"trntv/yii2-bootstrap-datetimepicker": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= $form->field($model, 'attribute')->widget('trntv\yii\datetimepicker\DatetimepickerWidget', [ ... options ...]); ?>
```

Options
-------
``phpDatetimeFormat`` - PHP ICU datetime format

``momentDatetimeFormat`` - Moment JS datetime format

``clientOptions`` - [see full list of available options](http://eonasdan.github.io/bootstrap-datetimepicker/#options)
