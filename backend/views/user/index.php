<?php

use common\grid\EnumColumn;
use common\models\User;
use kartik\date\DatePicker;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use rmrevin\yii\fontawesome\FAS;
use common\models\Dealership;

/**
 * @var yii\web\View $this
 * @var backend\models\search\UserSearch $searchModel
 * @var backend\models\search\UserSearch $adminSearch
 * @var backend\models\search\UserSearch $dealershipsSearch
 * @var backend\models\search\UserSearch $dealersSearch
 * @var backend\models\search\UserSearch $marketplaceSearch
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var yii\data\ActiveDataProvider $adminDataProvider
 * @var yii\data\ActiveDataProvider $dealershipsDataProvider
 * @var yii\data\ActiveDataProvider $dealersDataProvider
 * @var yii\data\ActiveDataProvider $marketplaceDataProvider
 * @var $roles yii\rbac\Role[]
 */
$this->title = Yii::t('backend', 'Users');
$this->params['breadcrumbs'][] = $this->title;
$roles = ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name');

$Admin_Role = array();
$Dealer_Role = array();
$User_Role = array();


foreach ($roles as $role) {
    if ($role == User::ROLE_AC_ADMIN || $role == User::ROLE_AC_ACCOUNT_REP) {
        $Admin_Role[$role] = $role;
    } else if ($role == User::ROLE_DEALERSHIP_SALE_REP || $role == User::ROLE_DEALERSHIP_MANAGER || $role == User::ROLE_DEALERSHIP_ADMIN) {
        $Dealer_Role[$role] = $role;
    } else if ($role == User::ROLE_USER) {
        $User_Role[$role] = $role;
    }
}
echo Html::a(FAS::icon('user-plus') . ' ' . Yii::t('backend', 'Add New {modelClass}', [
            'modelClass' => 'User',
        ]), ['create'], ['class' => 'btn btn-success float-right']) . '&nbsp;&nbsp;&nbsp;';
?>

<br><br>
<?php if (!\Yii::$app->getUser()->getIdentity()->dealership_id) { ?>
<div class="card card-primary card-outline card-outline-tabs">
    <div class="card-header p-0 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                   href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Admin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                   href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                   aria-selected="false">Dealership</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill"
                   href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages"
                   aria-selected="false">Marketplace</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-four-tabContent">
            <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel"
                 aria-labelledby="custom-tabs-four-home-tab">
                <?php echo GridView::widget([
                    'toolbar' => [
                        '{export}&nbsp;&nbsp;&nbsp;',
                        '{toggleData}'
                    ],
                    'panel' => [
                        'heading' => 'Admin Accounts',
                        'type' => GridView::TYPE_PRIMARY
                    ],
                    'dataProvider' => $adminDataProvider,
                    'filterModel' => $adminSearch,
                    'pjax' => true,
                    'pjaxSettings' => [
                        'neverTimeout' => true,
                    ],
                    'options' => [
                        'class' => ['gridview', 'table-responsive'],
                    ],
                    'tableOptions' => [
                        'class' => ['table', 'text-nowrap', 'table-striped', 'table-bordered', 'mb-0'],
                    ],
                    'columns' => [
                        [
                            'attribute' => 'id',
                            'options' => ['style' => 'width: 5%'],
                        ],
                        'username',
                        'email:email',


                        [
                            'attribute' => 'role',
                            'filterType' => GridView::FILTER_SELECT2,
                            'filterWidgetOptions' => [
                                'options' => ['prompt' => 'Admin Role', 'class' => 'form-control'],
                            ],
                            'value' => function ($model) {
                                return
                                    implode(',',
                                        ArrayHelper::map(
                                            Yii::$app->authManager->getRolesByUser($model->id),
                                            'name', 'name'
                                        )
                                    );
                            },
                            'filter' => $Admin_Role

                        ],


                        [
                            'attribute' => 'created_at',
                            'format' => 'datetime',
                            'filter' => DatePicker::widget([
                                'model' => $adminSearch,
                                'attribute' => 'created_at',
                                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                'pluginOptions' => [
                                    'format' => 'dd-mm-yyyy',
                                    'showMeridian' => true,
                                    'todayBtn' => true,
                                    'endDate' => '0d',
                                ]
                            ]),
                        ],
                        [
                            'attribute' => 'logged_at',
                            'format' => 'datetime',
                            'filter' => DatePicker::widget([
                                'model' => $adminSearch,
                                'attribute' => 'logged_at',
                                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                'pluginOptions' => [
                                    'format' => 'dd-mm-yyyy',
                                    'showMeridian' => true,
                                    'todayBtn' => true,
                                    'endDate' => '0d',
                                ]
                            ]),
                        ],
                        [
                            'class' => EnumColumn::class,
                            'attribute' => 'status',
                            'enum' => User::statuses(),
                            'filter' => User::statuses()
                        ],
                        // 'updated_at',

                        [
                            'class' => \common\widgets\ActionColumn::class,
                            'template' => '{login} {view} {update} {delete}',
                            'options' => ['style' => 'width: 140px'],
                            'buttons' => [
                                'login' => function ($url) {
                                    return Html::a(
                                        FAS::icon('sign-in-alt', ['aria' => ['hidden' => true], 'class' => ['fa-fw']]),
                                        $url,
                                        [
                                            'title' => Yii::t('backend', 'Login'),
                                            'class' => ['btn', 'btn-xs', 'btn-secondary']
                                        ]
                                    );
                                },
                            ],
                            'visibleButtons' => [
                                'login' => Yii::$app->user->can('AC_Admin')
                            ]

                        ],
                    ],
                ]); ?>
            </div>
            <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                 aria-labelledby="custom-tabs-four-profile-tab">
                <?php echo GridView::widget([
                    'toolbar' => [

                        '{export}&nbsp;&nbsp;&nbsp;',
                        '{toggleData}'
                    ],
                    'panel' => [
                        'heading' => 'Dealership Accounts',
                        'type' => GridView::TYPE_PRIMARY
                    ],
                    'dataProvider' => $dealershipsDataProvider,
                    'filterModel' => $dealershipsSearch,
                    'pjax' => true,
                    'pjaxSettings' => [
                        'neverTimeout' => true,
                    ],
                    'options' => [
                        'class' => ['gridview', 'table-responsive'],
                    ],
                    'tableOptions' => [
                        'class' => ['table', 'text-nowrap', 'table-striped', 'table-bordered', 'mb-0'],
                    ],
                    'columns' => [
                        [
                            'attribute' => 'id',
                            'options' => ['style' => 'width: 5%'],
                        ],
                        'username',
                        'email:email',

                        [
                            'attribute' => 'dealership_id',
                            'filterType' => GridView::FILTER_SELECT2,
                            'filterWidgetOptions' => [
                                'options' => ['prompt' => 'Dealership', 'class' => 'form-control'],
                            ],
                            'value' => function ($model) {
                                return
                                    implode(',',
                                        ArrayHelper::map(
                                            \common\models\Dealership::find()->where(['id' => $model->dealership_id])->all(),
                                            'id', 'business_name'
                                        )
                                    );
                            },
                            'filter' => ArrayHelper::map(\common\models\Dealership::find()->all(), 'id', 'business_name')
                        ],

                        [
                            'attribute' => 'created_at',
                            'format' => 'datetime',
                            'filter' => DatePicker::widget([
                                'model' => $dealershipsSearch,
                                'attribute' => 'created_at',
                                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                'pluginOptions' => [
                                    'format' => 'dd-mm-yyyy',
                                    'showMeridian' => true,
                                    'todayBtn' => true,
                                    'endDate' => '0d',
                                ]
                            ]),
                        ],
                        [
                            'attribute' => 'logged_at',
                            'format' => 'datetime',
                            'filter' => DatePicker::widget([
                                'model' => $dealershipsSearch,
                                'attribute' => 'logged_at',
                                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                'pluginOptions' => [
                                    'format' => 'dd-mm-yyyy',
                                    'showMeridian' => true,
                                    'todayBtn' => true,
                                    'endDate' => '0d',
                                ]
                            ]),
                        ],
                        [
                            'class' => EnumColumn::class,
                            'attribute' => 'status',
                            'enum' => User::statuses(),
                            'filter' => User::statuses()
                        ],
                        // 'updated_at',

                        [
                            'class' => \common\widgets\ActionColumn::class,
                            'template' => '{login} {view} {update} {delete}',
                            'options' => ['style' => 'width: 140px'],
                            'buttons' => [
                                'login' => function ($url) {
                                    return Html::a(
                                        FAS::icon('sign-in-alt', ['aria' => ['hidden' => true], 'class' => ['fa-fw']]),
                                        $url,
                                        [
                                            'title' => Yii::t('backend', 'Login'),
                                            'class' => ['btn', 'btn-xs', 'btn-secondary']
                                        ]
                                    );
                                },
                            ],
                            'visibleButtons' => [
                                'login' => Yii::$app->user->can('AC_Admin')
                            ]

                        ],
                    ],
                ]); ?>
            </div>
            <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                <?php echo GridView::widget([
                                'toolbar' => [

                                    '{export}&nbsp;&nbsp;&nbsp;',
                                    '{toggleData}'
                                ],
                                'panel' => [
                                    'heading'=> 'Marketplace Accounts',
                                    'type' => GridView::TYPE_PRIMARY
                                ],
                                'dataProvider' => $marketplaceDataProvider,
                                'filterModel' => $marketplaceSearch,
                                'pjax'=>true,
                                'pjaxSettings'=>[
                                    'neverTimeout'=>true,
                                ],
                                'options' => [
                                    'class' => ['gridview', 'table-responsive'],
                                ],
                                'tableOptions' => [
                                    'class' => ['table', 'text-nowrap', 'table-striped', 'table-bordered', 'mb-0'],
                                ],
                                'columns' => [
                                    [
                                        'attribute' => 'id',
                                        'options' => ['style' => 'width: 5%'],
                                    ],
                                    'username',
                                    'email:email',
                                    [
                                        'attribute' => 'created_at',
                                        'format' => 'datetime',
                                        'filter' => DatePicker::widget([
                                            'model' => $marketplaceSearch,
                                            'attribute' => 'created_at',
                                            'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                            'pluginOptions' => [
                                                'format' => 'dd-mm-yyyy',
                                                'showMeridian' => true,
                                                'todayBtn' => true,
                                                'endDate' => '0d',
                                            ]
                                        ]),
                                    ],
                                    [
                                        'attribute' => 'logged_at',
                                        'format' => 'datetime',
                                        'filter' => DatePicker::widget([
                                            'model' => $marketplaceSearch,
                                            'attribute' => 'logged_at',
                                            'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                            'pluginOptions' => [
                                                'format' => 'dd-mm-yyyy',
                                                'showMeridian' => true,
                                                'todayBtn' => true,
                                                'endDate' => '0d',
                                            ]
                                        ]),
                                    ],
                                    [
                                        'class' => EnumColumn::class,
                                        'attribute' => 'status',
                                        'enum' => User::statuses(),
                                        'filter' => User::statuses()
                                    ],
                                ],
                            ]); ?>
            </div>
        </div>
    </div>
</div>
<?php }else
{
    echo GridView::widget([
        'toolbar' => [
            '{export}&nbsp;&nbsp;&nbsp;',
            '{toggleData}'
        ],
        'panel' => [
            'heading' => 'Dealership Accounts',
            'type' => GridView::TYPE_PRIMARY
        ],
        'dataProvider' => $dealersDataProvider,
        'filterModel' => $dealersSearch,
        'pjax' => true,
        'pjaxSettings' => [
            'neverTimeout' => true,
        ],
        'options' => [
            'class' => ['gridview', 'table-responsive'],
        ],
        'tableOptions' => [
            'class' => ['table', 'text-nowrap', 'table-striped', 'table-bordered', 'mb-0'],
        ],
        'columns' => [
            [
                'attribute' => 'id',
                'options' => ['style' => 'width: 5%'],
            ],
            'username',
            'email:email',


            [
                'attribute' => 'role',
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'options' => ['prompt' => 'Dealers Role', 'class' => 'form-control'],
                ],
                'value' => function ($model) {
                    return
                        implode(',',
                            ArrayHelper::map(
                                Yii::$app->authManager->getRolesByUser($model->id),
                                'name', 'name'
                            )
                        );
                },
                'filter' => $Dealer_Role

            ],


            [
                'attribute' => 'created_at',
                'format' => 'datetime',
                'filter' => DatePicker::widget([
                    'model' => $dealersSearch,
                    'attribute' => 'created_at',
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'pluginOptions' => [
                        'format' => 'dd-mm-yyyy',
                        'showMeridian' => true,
                        'todayBtn' => true,
                        'endDate' => '0d',
                    ]
                ]),
            ],
            [
                'attribute' => 'logged_at',
                'format' => 'datetime',
                'filter' => DatePicker::widget([
                    'model' => $dealersSearch,
                    'attribute' => 'logged_at',
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'pluginOptions' => [
                        'format' => 'dd-mm-yyyy',
                        'showMeridian' => true,
                        'todayBtn' => true,
                        'endDate' => '0d',
                    ]
                ]),
            ],
            [
                'class' => EnumColumn::class,
                'attribute' => 'status',
                'enum' => User::statuses(),
                'filter' => User::statuses()
            ],
            // 'updated_at',

            [
                'class' => \common\widgets\ActionColumn::class,
                'template' => '{login} {view} {update} {delete}',
                'options' => ['style' => 'width: 140px'],
                'buttons' => [
                    'login' => function ($url) {
                        return Html::a(
                            FAS::icon('sign-in-alt', ['aria' => ['hidden' => true], 'class' => ['fa-fw']]),
                            $url,
                            [
                                'title' => Yii::t('backend', 'Login'),
                                'class' => ['btn', 'btn-xs', 'btn-secondary']
                            ]
                        );
                    },
                ],
                'visibleButtons' => [
                    'login' => Yii::$app->user->can('AC_Admin')
                ]

            ],
        ],
    ]);
}?>







<style>
    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 38px !important;
        user-select: none;
        -webkit-user-select: none;
        width: 100%;
    }

    .select2-container--default .select2-selection--single {

        border: 1px solid #EAEAEA !important;
        border-radius: 4px !important;
        font-weight: 400;
        font-size: 15px;
        line-height: 16px;
        padding: 8px;


    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        display: none;
    }

    .select2-selection__arrow {
        display: none !important;
    }
</style>