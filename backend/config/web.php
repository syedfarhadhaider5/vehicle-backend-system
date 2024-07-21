<?php
$config = [
    'homeUrl' => Yii::getAlias('@backendUrl'),
    'controllerNamespace' => 'backend\controllers',
    'defaultRoute' => 'user/index',
    'components' => [
        'assetManager' => [
            'bundles' => [
                'dosamigos\google\maps\MapAsset' => [
                    'options' => [
                        'key' => 'AIzaSyCbRL4QS9DDFskNJBTTH_ETGvpKxX1b7XQ',
                        'libraries' => 'places',
                        'version' => '3.1.18',
                        'callback' => 'initMap'
                    ]
                ]
            ]
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'request' => [
            'cookieValidationKey' => env('BACKEND_COOKIE_VALIDATION_KEY'),
            'baseUrl' => env('BACKEND_BASE_URL'),
        ],
        'user' => [
            'class' => yii\web\User::class,
            'identityClass' => common\models\User::class,
            'loginUrl' => ['sign-in/login'],
            'enableAutoLogin' => true,
            'as afterLogin' => common\behaviors\LoginTimestampBehavior::class,
        ],
    ],
    'modules' => [
        'content' => [
            'class' => backend\modules\content\Module::class,
        ],
        'admin' => [
            'class' => backend\modules\admin\Module::class,
        ],
        'dealership' => [
            'class' => backend\modules\dealership\Module::class,
        ],
        'file' => [
            'class' => backend\modules\file\Module::class,
        ],
        'system' => [
            'class' => backend\modules\system\Module::class,
        ],
        'translation' => [
            'class' => backend\modules\translation\Module::class,
        ],
        'rbac' => [
            'class' => backend\modules\rbac\Module::class,
            'defaultRoute' => 'rbac-auth-item/index',
        ],
        'gridview' => ['class' => 'kartik\grid\Module']
    ],
    'as globalAccess' => [
        'class' => common\behaviors\GlobalAccessBehavior::class,
        'rules' => [
            [
                'controllers' => ['sign-in'],
                'allow' => true,
                'roles' => ['?'],
                'actions' => ['login'],
            ],
            [
                'controllers' => ['sign-in'],
                'allow' => true,
                'roles' => ['@'],
                'actions' => ['logout'],
            ],
            [
                'controllers' => ['site'],
                'allow' => true,
                'roles' => ['?', '@'],
                'actions' => ['error'],
            ],
            [
                'controllers' => ['debug/default'],
                'allow' => true,
                'roles' => ['?'],
            ],
//            [
//                'controllers' => ['user'],
//                'allow' => true,
//                'roles' => ['AC_ADMIN'],
//            ],
//            [
//                'controllers' => [
//                    //For testing will remove the user after role implementations
//                    'user',
//                    'dealership/listing',
//                    'dealership/messages',
//                    'dealership/ad-review',
//                    'dealership/marketing',
//                    'dealership/leads-manager',
//                ],
//                'allow' => true,
//                'roles' => ['LOGIN_TO_BACKEND'],
//            ],
            [
                'controllers' => [
                    'user',
                    'dealership/listing',
                    'dealership/messages',
                    'dealership/ad-review',
                    'dealership/marketing',
                    'dealership/leads-manager',
                    'dealership/lead',
                    'sign-in',
                ],
                'allow' => true,
                'roles' => [\common\models\User::ROLE_DEALERSHIP_ADMIN],
            ],
            [
                'allow' => true,
                'roles' => [\common\models\User::ROLE_AC_ADMIN],
            ],
        ],
    ],
];

if (YII_ENV_DEV) {
    $config['modules']['gii'] = [
        'class' => yii\gii\Module::class,
        'generators' => [
            'crud' => [
                'class' => yii\gii\generators\crud\Generator::class,
                'templates' => [
                    'yii2-starter-kit' => Yii::getAlias('@backend/views/_gii/templates'),
                ],
                'template' => 'yii2-starter-kit',
                'messageCategory' => 'backend',
            ],
        ],
    ];
}

return $config;
