Redis Log for Yii 2
===============================================

Requirements
------------

At least redis version 2.6.12 is required for all components to work properly.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist jackychan/yii2-redis-log
```

or add

```json
"jackychan/yii2-redis-log": "~2.0.0"
```

to the require section of your composer.json.


Configuration
-------------

To use this extension, you have to configure the Connection class in your application configuration:

```php
return [
    //....
    'components' => [
        'log' => [
            'targets' => [
				'redis' => [
					'class' => 'jc\yii\redis\RedisTarget',
					'redis' => 'redis',
					'levels' => ['trace', 'info'],
					'categories' => ['yii\*'],
				]
			]
        ],
    ]
];
```