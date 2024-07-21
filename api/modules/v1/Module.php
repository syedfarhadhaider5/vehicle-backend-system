<?php

namespace api\modules\v1;


use Yii;
use yii\filters\ContentNegotiator;
use yii\filters\RateLimiter;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;

use yii\web\Response;

class Module extends \yii\base\Module
{
    /** @var string */
    public $controllerNamespace = 'api\modules\v1\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        Yii::$app->user->identityClass = 'common\models\User';
        Yii::$app->user->enableSession = false;
        Yii::$app->user->loginUrl = null;
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Methods' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Allow' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Allow-Credentials' => null,
                'Access-Control-Max-Age' => 86400,
                'Access-Control-Expose-Headers' =>
                    ["X-Pagination-Total-Count, X-Pagination-Page-Count, X-Pagination-Current-Page, X-Pagination-Per-Page"]
            ]

        ];
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
//            'authMethods' => [
//                HttpBearerAuth::class,
//            ],
        ];

        $behaviors['authenticator']['except'][] = 'user/login';
        $behaviors['authenticator']['except'][] = 'user/sign-up';

        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON
            ],
        ];

//        $behaviors['rateLimiter'] = [
//            'class' => RateLimiter::class,
//        ];

        return $behaviors;
    }
}
