<?php
return [
    'class' => 'yii\web\UrlManager',
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        // Api
        ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/vehicle'],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/dealership'],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/make'],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/model'],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/vehicle-view'],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/color'],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/image'],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/saved-vehicle'],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/testimonial'],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/user'],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/lead'],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/lead-document'],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/lead-term'],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/lead-signed-agreement'],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/lead-final-agreement'],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/user-profile'],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/co-signer']
    ]
];
