<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/3/14
 * Time: 3:14 PM
 */

namespace backend\assets;

use common\assets\AdminLte;
use common\assets\Html5shiv;
use yii\web\AssetBundle;
use yii\web\YiiAsset;
use rmrevin\yii\fontawesome\NpmFreeAssetBundle;

class BackendAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@backend/web';

    /**
     * @var array
     */
    public $css = [
        'vendor/jquery-nice-select/css/nice-select.css',
        'vendor/nouislider/nouislider.min.css',
        'css/style.css',
    ];
    /**
     * @var array
     */
    public $js = [
        'vendor/global/global.min.js',
        'vendor/chart.js/Chart.bundle.min.js',
        'vendor/jquery-nice-select/js/jquery.nice-select.min.js',
        'vendor/apexchart/apexchart.js',
        'vendor/nouislider/nouislider.min.js',
        'vendor/wnumb/wNumb.js',
        'js/dashboard/dashboard-1.js',
        'js/custom.min.js',
        'js/dlabnav-init.js',
        'app.js',
    ];

    public $publishOptions = [
        'only' => [
            '*.css',
            '*.js',
            '../img/*'
        ],
        "forceCopy" => YII_ENV_DEV,
    ];

    /**
     * @var array
     */
    public $depends = [
//        YiiAsset::class,
//        AdminLte::class,
//        Html5shiv::class,
    ];
}
