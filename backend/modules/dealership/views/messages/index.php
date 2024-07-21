<?php

use common\grid\EnumColumn;
use common\models\Article;
use common\models\ArticleCategory;
use kartik\date\DatePicker;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FAS;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */

?>
<div class="row">
    <div class="col-sm-12">
        <iframe width="100%" frameborder="0"
                src="<?= 'http://chat.autocenter.com/launch/' . Yii::$app->user->getIdentity()->access_token; ?>"></iframe>
    </div>
</div>


<style>
    .content-header {
        display: none;
    }

    .content {
        padding: 0 !important;
        margin: 0 !important;
    }

    .container-fluid {
        padding: 0 !important;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    ;(function ($) {
        $(document).ready(function () {
            $('iframe').height($(window).height());
            $(window).resize(function () {
                $('iframe').height($(this).height());
            });
        });
    })(jQuery);
</script>