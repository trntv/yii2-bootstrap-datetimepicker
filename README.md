Yii2 DateTimePicker
===================
Datetimepicker widget for Yii2 framework
Based on [https://github.com/Eonasdan/bootstrap-datetimepicker](https://github.com/Eonasdan/bootstrap-datetimepicker)
**NOTE** Here might be some bugs or follies. Contribute to remove them ;)


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist trntv/yii2-bootstrap-datetimepicker "*"
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
<?= $form->field($model, 'attribute')->widget('trntv\yii\datetimepicker\DatetimepickerWidget'); ?>```

Options
-------
``format`` - datetime format
``clientOptions`` - [http://eonasdan.github.io/bootstrap-datetimepicker/#options](http://eonasdan.github.io/bootstrap-datetimepicker/#options)