<?php

use common\grid\EnumColumn;
use common\models\Article;
use common\models\ArticleCategory;
use kartik\date\DatePicker;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FAS;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('backend', 'Dealership Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'My Dealers'), 'url' => ['dealer/index']];
$this->params['breadcrumbs'][] = $this->title;


/** @var \common\models\Dealership $model */
?>

<div class="row">
    <?php
    echo $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
