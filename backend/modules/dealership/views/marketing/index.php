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

$this->title = Yii::t('backend', 'Marketing');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class=" container-fluid">
    <p class="total-spend-heading">TOTAL SPEND</p>
    <div class="row">

        <div class="col-md-3">
            <div class="total-spend-grid-box">
                <p class="total-spend-grid-box-title">REACH</p>
                <p class="total-spend-grid-box-counter">+34</p>
                <div class="total-spend-counter-info">
                    <img src="<?= Yii::$app->getUrlManager()->createUrl("images/total-spend-counter-info-up-arrow.svg"); ?>"
                         class="img-fluid-up" alt="">
                    <p class="counter-info-count counter-info-up-count">+7.6%</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="total-spend-grid-box">
                <p class="total-spend-grid-box-title">VIEWS</p>
                <p class="total-spend-grid-box-counter">1,698</p>
                <div class="total-spend-counter-info">
                    <img src="<?= Yii::$app->getUrlManager()->createUrl("images/total-spend-counter-info-down-arrow.svg") ?>"
                         class="img-fluid-down" alt="">
                    <p class="counter-info-count counter-info-down-count">134</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="total-spend-grid-box">
                <p class="total-spend-grid-box-title">TOTAL SPEND ($)</p>
                <p class="total-spend-grid-box-counter">$1,784</p>
                <div class="total-spend-counter-info">
                    <img src="<?= Yii::$app->getUrlManager()->createUrl("images/total-spend-counter-info-up-arrow.svg"); ?>"
                         class="img-fluid-up" alt="">
                    <p class="counter-info-count counter-info-up-count">+2.4%</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="total-spend-grid-box">
                <div class="speedometer">
                    <svg width="179" class="js-guage-svg guage-svg" height="106" viewBox="0 0 179 106" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.51184 105.827C1.39648 105.208 1.28753 104.586 1.18506 103.962L22.3553 100.485C22.4331 100.959 22.5158 101.431 22.6034 101.901L1.51184 105.827Z"
                              fill="#E0E7FF"/>
                        <path d="M0.420549 98.1014C0.359997 97.4771 0.305895 96.8511 0.258301 96.2236L21.6507 94.6012C21.687 95.079 21.7281 95.5554 21.7742 96.0303L0.420549 98.1014Z"
                              fill="#E0E7FF"/>
                        <path d="M21.4576 88.6691C21.4551 88.9094 21.4539 89.1501 21.4539 89.3911C21.4539 89.632 21.4551 89.8727 21.4576 90.113L0.00491905 90.3364C0.00164223 90.0216 0 89.7065 0 89.3911C0 89.0756 0.00164223 88.7605 0.00492096 88.4457L21.4576 88.6691Z"
                              fill="#E0E7FF"/>
                        <path d="M0.258301 82.5584C0.305895 81.9308 0.359997 81.3049 0.420549 80.6805L21.7742 82.7516C21.7281 83.2266 21.687 83.703 21.6507 84.1808L0.258301 82.5584Z"
                              fill="#E0E7FF"/>
                        <path d="M1 74.8201C1.10248 74.1962 1.21143 73.5743 1.32679 72.9546L22.4183 76.8807C22.3308 77.3512 22.248 77.8234 22.1702 78.2972L1 74.8201Z"
                              fill="#E0E7FF"/>
                        <path d="M2.60156 67.1791C2.75859 66.5655 2.92196 65.9544 3.09161 65.3458L23.7575 71.107C23.6288 71.5686 23.5048 72.0322 23.3857 72.4977L2.60156 67.1791Z"
                              fill="#E0E7FF"/>
                        <path d="M4.87012 59.6998C5.08002 59.1036 5.29603 58.5103 5.5181 57.92L25.5981 65.474C25.4296 65.9218 25.2657 66.3719 25.1065 66.8242L4.87012 59.6998Z"
                              fill="#E0E7FF"/>
                        <path d="M7.78564 52.4524C8.04667 51.8777 8.31356 51.3064 8.58624 50.7384L27.9266 60.0238C27.7196 60.455 27.517 60.8887 27.3188 61.3249L7.78564 52.4524Z"
                              fill="#E0E7FF"/>
                        <path d="M11.3218 45.4941C11.632 44.9447 11.9477 44.3989 12.269 43.8569L30.7239 54.7971C30.4797 55.2089 30.2398 55.6236 30.0041 56.041L11.3218 45.4941Z"
                              fill="#E0E7FF"/>
                        <path d="M15.4478 38.8774C15.8043 38.3575 16.1663 37.8415 16.5334 37.3297L33.9659 49.8348C33.6866 50.2241 33.4114 50.6165 33.1402 51.0118L15.4478 38.8774Z"
                              fill="#E0E7FF"/>
                        <path d="M20.1299 32.6492C20.5299 32.1627 20.935 31.6804 21.345 31.2026L37.6264 45.1734C37.3144 45.537 37.0062 45.9039 36.7018 46.2742L20.1299 32.6492Z"
                              fill="#E0E7FF"/>
                        <path d="M25.333 26.8532C25.7734 26.4035 26.2185 25.9583 26.6683 25.5179L41.6781 40.8467C41.3358 41.1819 40.997 41.5207 40.6618 41.8631L25.333 26.8532Z"
                              fill="#E0E7FF"/>
                        <path d="M31.0176 21.5303C31.4954 21.1203 31.9776 20.7152 32.4642 20.3152L46.0891 36.8871C45.7189 37.1915 45.3519 37.4997 44.9883 37.8117L31.0176 21.5303Z"
                              fill="#E0E7FF"/>
                        <path d="M37.1445 16.7185C37.6564 16.3513 38.1723 15.9894 38.6922 15.6328L50.8266 33.3253C50.4313 33.5964 50.0389 33.8717 49.6497 34.1509L37.1445 16.7185Z"
                              fill="#E0E7FF"/>
                        <path d="M43.6719 12.454C44.2139 12.1327 44.7597 11.8169 45.3091 11.5067L55.856 30.1891C55.4386 30.4247 55.0239 30.6647 54.612 30.9088L43.6719 12.454Z"
                              fill="#E0E7FF"/>
                        <path d="M50.5532 8.7713C51.1212 8.49862 51.6925 8.23173 52.2672 7.9707L61.1397 27.5039C60.7035 27.702 60.2698 27.9046 59.8386 28.1117L50.5532 8.7713Z"
                              fill="#E0E7FF"/>
                        <path d="M57.7349 5.7034C58.3252 5.48134 58.9184 5.26532 59.5147 5.05542L66.639 25.2918C66.1867 25.451 65.7366 25.6149 65.2888 25.7834L57.7349 5.7034Z"
                              fill="#E0E7FF"/>
                        <path d="M65.1606 3.27666C65.7692 3.10702 66.3803 2.94365 66.9939 2.78662L72.3125 23.5708C71.847 23.6899 71.3834 23.8138 70.9218 23.9425L65.1606 3.27666Z"
                              fill="#E0E7FF"/>
                        <path d="M72.7695 1.51172C73.3893 1.39636 74.0111 1.28741 74.6351 1.18494L78.1122 22.3551C77.6383 22.433 77.1661 22.5157 76.6956 22.6033L72.7695 1.51172Z"
                              fill="#E0E7FF"/>
                        <path d="M80.4956 0.420549C81.1199 0.359997 81.7459 0.305895 82.3735 0.258301L83.9959 21.6507C83.5181 21.687 83.0417 21.7281 82.5667 21.7742L80.4956 0.420549Z"
                              fill="#E0E7FF"/>
                        <path d="M89.2061 0C89.5215 0 89.8366 0.00164223 90.1514 0.00492096L89.9281 21.4576C89.6877 21.4551 89.447 21.4539 89.2061 21.4539C88.9651 21.4539 88.7245 21.4551 88.4841 21.4576L88.2607 0.00491905C88.5755 0.00164223 88.8907 0 89.2061 0Z"
                              fill="#E0E7FF"/>
                        <path d="M96.0384 0.258301C96.666 0.305895 97.2919 0.359997 97.9163 0.420549L95.8452 21.7742C95.3702 21.7281 94.8938 21.687 94.416 21.6507L96.0384 0.258301Z"
                              fill="#E0E7FF"/>
                        <path d="M103.777 1.18506C104.401 1.28753 105.023 1.39649 105.642 1.51185L101.716 22.6034C101.246 22.5158 100.774 22.4331 100.3 22.3553L103.777 1.18506Z"
                              fill="#E0E7FF"/>
                        <path d="M111.418 2.78674C112.031 2.94377 112.642 3.10714 113.251 3.27679L107.49 23.9426C107.028 23.8139 106.565 23.69 106.099 23.5709L111.418 2.78674Z"
                              fill="#E0E7FF"/>
                        <path d="M118.897 5.05542C119.493 5.26532 120.087 5.48134 120.677 5.7034L113.123 25.7834C112.675 25.6149 112.225 25.451 111.773 25.2918L118.897 5.05542Z"
                              fill="#E0E7FF"/>
                        <path d="M126.145 7.97083C126.719 8.23185 127.291 8.49874 127.858 8.77142L118.573 28.1118C118.142 27.9048 117.708 27.7022 117.272 27.504L126.145 7.97083Z"
                              fill="#E0E7FF"/>
                        <path d="M133.103 11.5068C133.652 11.817 134.198 12.1328 134.74 12.4541L123.8 30.9089C123.388 30.6648 122.974 30.4249 122.556 30.1892L133.103 11.5068Z"
                              fill="#E0E7FF"/>
                        <path d="M139.719 15.6328C140.239 15.9894 140.755 16.3513 141.267 16.7185L128.762 34.1509C128.373 33.8717 127.98 33.5964 127.585 33.3253L139.719 15.6328Z"
                              fill="#E0E7FF"/>
                        <path d="M145.948 20.3153C146.434 20.7153 146.916 21.1204 147.394 21.5304L133.424 37.8119C133.06 37.4999 132.693 37.1916 132.323 36.8872L145.948 20.3153Z"
                              fill="#E0E7FF"/>
                        <path d="M151.744 25.5179C152.193 25.9583 152.639 26.4035 153.079 26.8532L137.75 41.8631C137.415 41.5207 137.076 41.1819 136.734 40.8467L151.744 25.5179Z"
                              fill="#E0E7FF"/>
                        <path d="M157.067 31.2026C157.477 31.6804 157.882 32.1627 158.282 32.6492L141.71 46.2742C141.405 45.9039 141.097 45.537 140.785 45.1734L157.067 31.2026Z"
                              fill="#E0E7FF"/>
                        <path d="M161.879 37.3298C162.246 37.8417 162.608 38.3576 162.964 38.8775L145.272 51.0119C145.001 50.6166 144.726 50.2242 144.446 49.835L161.879 37.3298Z"
                              fill="#E0E7FF"/>
                        <path d="M166.143 43.8571C166.464 44.3991 166.78 44.9448 167.09 45.4943L148.408 56.0412C148.172 55.6237 147.932 55.2091 147.688 54.7972L166.143 43.8571Z"
                              fill="#E0E7FF"/>
                        <path d="M169.826 50.7385C170.098 51.3065 170.365 51.8778 170.626 52.4525L151.093 61.325C150.895 60.8888 150.692 60.4551 150.485 60.0239L169.826 50.7385Z"
                              fill="#E0E7FF"/>
                        <path d="M172.893 57.92C173.116 58.5103 173.332 59.1036 173.541 59.6998L153.305 66.8242C153.146 66.3719 152.982 65.9218 152.813 65.474L172.893 57.92Z"
                              fill="#E0E7FF"/>
                        <path d="M175.32 65.3459C175.49 65.9545 175.653 66.5656 175.81 67.1792L155.026 72.4978C154.907 72.0323 154.783 71.5687 154.654 71.1071L175.32 65.3459Z"
                              fill="#E0E7FF"/>
                        <path d="M177.085 72.9547C177.201 73.5744 177.309 74.1963 177.412 74.8202L156.242 78.2973C156.164 77.8235 156.081 77.3513 155.994 76.8808L177.085 72.9547Z"
                              fill="#E0E7FF"/>
                        <path d="M178.176 80.6807C178.237 81.305 178.291 81.931 178.339 82.5585L156.946 84.1809C156.91 83.7031 156.869 83.2267 156.823 82.7518L178.176 80.6807Z"
                              fill="#E0E7FF"/>
                        <path d="M157.139 90.1131C157.142 89.8728 157.143 89.6321 157.143 89.3911C157.143 89.1502 157.142 88.9095 157.139 88.6692L178.592 88.4458C178.595 88.7606 178.597 89.0757 178.597 89.3911C178.597 89.7066 178.595 90.0217 178.592 90.3365L157.139 90.1131Z"
                              fill="#E0E7FF"/>
                        <path d="M178.339 96.2237C178.291 96.8513 178.237 97.4772 178.176 98.1016L156.823 96.0305C156.869 95.5555 156.91 95.0791 156.946 94.6013L178.339 96.2237Z"
                              fill="#E0E7FF"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M155.994 101.901L177.085 105.827C177.201 105.208 177.31 104.586 177.412 103.962L156.242 100.485C156.164 100.959 156.081 101.431 155.994 101.901Z"
                              fill="#E0E7FF"/>
                    </svg>
                    <div class="score-data">
                        <h3>83</h3>
                        <span>OVERALL<br>
                                SCORE</span>
                    </div>

                    <div class="js-needle needle"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="dropdown">
                <button type="button" class="btn dropdown-toggle1" data-toggle="dropdown">
                    Ad Center
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Link 1</a>
                    <a class="dropdown-item" href="#">Link 2</a>
                    <a class="dropdown-item" href="#">Link 3</a>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="dropdown">
                <button type="button" class="btn btn-dropdown-toggle1" data-toggle="dropdown">
                    Active
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Inactive</a>
                    <a class="dropdown-item" href="#">Paused</a>
                    <a class="dropdown-item" href="#">Rejected</a>
                    <a class="dropdown-item" href="#">In-Review</a>
                    <a class="dropdown-item" href="#">Completed</a>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <button class="btn btn-new-ad">Create New Ad</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="table-responsive">
                <table class="table" id="sortable">
                    <thead>
                    <th class="tbl-header-text" id="header-row" onclick="sortBy(0)">NUMBER
                        <svg style="margin-left: 10px;" width="10" height="6" viewBox="0 0 10 6" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M9.8499 1.23444L5.36159 5.7232C5.16176 5.92283 4.8381 5.92283 4.6385 5.7232L0.149705 1.23444C-0.0499017 1.03473 -0.0499017 0.711109 0.149705 0.511404L0.511238 0.149871C0.710845 -0.0499635 1.03479 -0.0499635 1.23453 0.149871L5 3.91553L8.76559 0.149871C8.96517 -0.0499635 9.28895 -0.0499635 9.48862 0.149871L9.85016 0.511404C10.05 0.711337 10.05 1.03473 9.8499 1.23444Z"
                                  fill="#0C2434"/>
                        </svg>
                    </th>
                    <th class="tbl-header-text" id="header-row" onclick="sortBy(1)">AD TYPE</th>
                    <th class="tbl-header-text" id="header-row" onclick="sortBy(2)">AD LABEL</th>
                    <th class="tbl-header-text" id="header-row" onclick="sortBy(3)">Daily budget</th>
                    <th class="tbl-header-text" id="header-row" onclick="sortBy(4)">Duration</th>
                    <th class="tbl-header-text" id="header-row" onclick="sortBy(5)">RADIUS SELECTED</th>
                    <th class="tbl-header-text" id="header-row" onclick="sortBy(6)"></th>
                    </thead>
                    <tbody>
                    <tr>
                        <td id="first-column">#12345</td>
                        <td class="brand-name">Brand Awareness</td>
                        <td>Online</td>
                        <td>$50</td>
                        <td>2 Weeks</td>
                        <td>25 Miles</td>
                        <td><a href="#" class="manage-link">Manage</a></td>
                    </tr>
                    <tr>
                        <td id="second-column">#12355</td>
                        <td>Brand Awareness</td>
                        <td>Online</td>
                        <td>$50</td>
                        <td>2 Weeks</td>
                        <td>25 Miles</td>
                        <td><a href="#" class="manage-link">Manage</a></td>
                    </tr>
                    <tr>
                        <td id="third-column">#12348</td>
                        <td>Brand Awareness</td>
                        <td>Online</td>
                        <td>$50</td>
                        <td>2 Weeks</td>
                        <td>25 Miles</td>
                        <td><a href="#" class="manage-link">Manage</a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-12">
        </div>
        <div class="col-md-2 col-12">
            <button class="btn btn-pause">Pause All Ads</button>
        </div>
        <div class="col-md-2 col-12">
            <button class="btn btn-billing">Billing</button>
        </div>
    </div>

    <div class="row" id="last-row">
        <div class="col-md-2 col-12">
            <div class="user-profile">
                <img src="<?= Yii::$app->getUrlManager()->createUrl("images/dashboard-user-info-bottom.png") ?>"
                     class="img-fluid" alt="">
                <p class="user-name">Joseph William</p>
                <p class="user-designation">Administrator</p>
                <button class="btn btn-premium-account">Premium Account</button>
                <button class="btn btn-update-profile">Update Profile</button>
            </div>
        </div>
        <div class="col-md-2 col-12">
            <div class="user-details">
                <div class="user-details-inner">
                    <p class="user-details-title">Role</p>
                    <p class="user-details-description">Marketing Manager</p>
                </div>
                <div class="user-details-inner">
                    <p class="user-details-title">Email</p>
                    <p class="user-details-description">joseph.william@autoc.com</p>
                </div>
                <div class="user-details-inner">
                    <p class="user-details-title">Phone</p>
                    <p class="user-details-description">+123–3456–7899</p>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-12">
            <div class="user-details">
                <div class="user-details-inner">
                    <p class="user-details-title">Location</p>
                    <p class="user-details-description">New York, NY</p>
                </div>
                <div class="user-details-inner">
                    <p class="user-details-title">Bio</p>
                    <p class="user-details-description">Car dealership representative for various car dealerships across
                        New York and the surounding areas.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-12" id="bellance-box">
            <div class="user-counter-info">
                <div class="user-counter-inner">
                    <p class="user-counter-sub-title">credit</p>
                    <h2 class="user-counter-main-title">£347</h2>
                </div>
                <div class="user-counter-inner">
                    <p class="user-counter-sub-title">balance due</p>
                    <h2 class="user-counter-main-title active">£1,189</h2>
                </div>
                <div class="user-counter-inner">
                    <p class="user-counter-sub-title">total spent</p>
                    <h2 class="user-counter-main-title">£2,189</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .total-spend-grid-box {
        background: #FFFFFF;
        margin-bottom: 20px;
        padding: 25px 40px 35px 40px;
        -webkit-filter: drop-shadow(0px 10.4067px 20.8134px rgba(46, 91, 255, 0.071));
        filter: drop-shadow(0px 10.4067px 20.8134px rgba(46, 91, 255, 0.071));


    }

    .total-spend-grid-box-title {
        font-size: 14px;
        line-height: 16px;
        color: #8798AD;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .total-spend-grid-box-title2 {
        font-size: 14px;
        line-height: 16px;
        color: #0C2434;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .total-spend-grid-box-counter {
        color: #192F54;
        font-weight: 500;
        font-size: 42px;
        line-height: 48px;
        margin-bottom: 12px;
    }

    .total-spend-counter-info {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        vertical-align: middle;
    }

    .counter-info-up-count {
        color: #2DB744;

    }

    .counter-info-count {
        font-size: 17px;
        line-height: 19px;
        margin-left: 6px;

    }

    .counter-info-down-count {
        color: #B71E1E;
    }

    .speedometer {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        position: relative;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
    }

    .speedometer svg {
        height: 130px;
        -o-object-fit: contain;
        object-fit: contain;
        width: 200px;
    }

    .speedometer svg path {
        fill: #E0E7FF;
    }

    .speedometer .score-data {
        margin-top: 60px;
        text-align: center;
        position: absolute;
    }

    .speedometer .score-data h3 {
        font-weight: 700;
        font-size: 42.9077px;
        line-height: 50px;
        text-align: center;
        letter-spacing: -0.536346px;
        color: #0C2434;
    }

    .speedometer .score-data span {
        font-weight: 400;
        font-size: 12px;
        line-height: 14px;
        text-align: center;
        letter-spacing: 1.08461px;
        text-transform: uppercase;
        color: #8798AD;
    }

    .img-fluid-down, .img-fluid-up {
        margin-top: -15px;
    }

    .total-spend-heading {
        font-size: 12px;
        line-height: 14px;
        color: #8798AD;
        text-transform: uppercase;
        margin-bottom: 7px;
    }

    .dropdown-toggle1 {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        font-weight: 700;
        font-size: 34px;
        line-height: 39px;
        letter-spacing: -0.01em;
        color: #0C2434;
        margin-bottom: 10px;
    }

    .dropdown-toggle1::after {
        background: url("<?= Yii::$app->getUrlManager()->createUrl('images/ad-center-caret.svg')?>") no-repeat;
        content: '';
        border: none;
        height: 16px;
        width: 16px;
        background-size: 100% auto;
    }

    .btn-dropdown-toggle1 {
        background: rgba(228, 232, 248, 0.74);
        border: 1px solid #000000;
        padding: 0 15px;
        border-radius: 8px;
        width: 100%;
        max-width: 100%;
        height: 40px;
        font-weight: 500;
        font-size: 14px;
        line-height: 16px;
        color: #0C2434;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .btn-dropdown-toggle1::after {
        background: url("<?= Yii::$app->getUrlManager()->createUrl('images/ad-center-caret.svg')?>") no-repeat;
        content: '';
        height: 6px;
        width: 10px;
        position: absolute;
        top: 50%;
        right: 15px;
    }

    .btn-new-ad {
        background: #0C2434;
        font-weight: 700;
        font-size: 14px;
        line-height: 16px;
        text-align: center;
        width: 100%;
        color: #FFFFFF;
        height: 40px;
        margin-bottom: 10px;
    }

    .tbl-header-text {
        font-weight: 500;
        font-size: 12px;
        line-height: 14px;
        letter-spacing: 1.12px;
        text-transform: uppercase;
        color: #9198A7;

    }

    #header-row {
        border-top: none;
        border-bottom: 1px solid rgba(46, 91, 255, 0.08);
        cursor: pointer;
    }

    td {

        font-weight: 400;
        font-size: 15px;
        line-height: 40px;
        color: #2E384D;
        border-bottom: 1px solid rgba(46, 91, 255, 0.08);

    }

    tbody > tr {
        background: #FFFFFF;
        border: 1px solid rgba(46, 91, 255, 0.08);
        border-radius: 1px;

    }

    #first-column {
        border-left: 1px solid rgba(46, 91, 255, 0.08);
        font-weight: 500;
        font-size: 15px;
        line-height: 35px;
        color: #2E384D;
        padding: 15px;
    }

    .manage-link {
        font-weight: 500;
        font-size: 15px;
        line-height: 21px;
        text-align: center;
        color: #B71E1E;
    }

    .manage-link:hover {
        text-decoration: none;
        color: #B71E1E;
    }

    .btn-pause {
        border: 2px solid #000000;
        font-weight: 700;
        font-size: 14px;
        line-height: 16px;
        text-align: center;
        color: #0C2434;
        background: transparent;
        width: 100%;
        height: 40px;
        margin-bottom: 10px;
    }

    .btn-billing {
        background: #0C2434;
        font-weight: 700;
        font-size: 14px;
        line-height: 16px;
        text-align: center;
        margin-bottom: 10px;
        color: #FFFFFF;
        width: 100%;
        height: 40px;
    }

    .user-name {
        font-weight: 500;
        font-size: 22px;
        line-height: 22px;
        margin-bottom: 5px;
        color: #0C2434;

    }

    .user-designation {
        font-size: 15px;
        line-height: 22px;
        color: #B71E1E;
        margin-bottom: 27px;
    }

    .btn-premium-account, .btn-premium-account:hover {
        background: rgba(183, 30, 30, 0.25);
        font-weight: 700;
        font-size: 14px;
        line-height: 16px;
        text-align: center;
        color: #B71E1E;

        height: 40px;
        width: 100%;
        margin-bottom: 10px;
    }

    .btn-update-profile, .btn-update-profile:hover {
        background: #0C2434;
        font-weight: 700;
        font-size: 14px;
        line-height: 16px;
        text-align: center;
        width: 100%;

        height: 40px;
        color: #FFFFFF;
        margin-bottom: 10px;
    }

    #last-row {
        background: #FFFFFF;
        border: 1px solid rgba(46, 91, 255, 0.08);
        border-radius: 1px;
        margin: 10px 0px;
    }

    .user-profile {
        padding: 42px 30px 30px;
    }

    .user-details {
        padding: 50px 30px 30px;
    }

    .user-details-title {
        font-weight: 500;
        font-size: 12px;
        line-height: 14px;
        letter-spacing: 1.125px;
        text-transform: uppercase;
        color: #B0BAC9;
        margin-bottom: 6px;
    }

    .user-details-description {
        font-size: 15px;
        line-height: 22px;
        color: #2E384D;
    }

    #bellance-box {
        background: #0C2434;
        padding: 51px 52px 61px 62px;
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;

    }

    .user-counter-sub-title {
        font-weight: 500;
        font-size: 12px;
        line-height: 14px;
        letter-spacing: 1.125px;
        text-transform: uppercase;
        color: #B0BAC9;
        margin-bottom: 9px;
    }

    .user-counter-main-title {
        font-weight: 500;
        font-size: 30px;
        line-height: 22px;
        color: #F0F2F8;
        margin-bottom: 23px;
    }

    .user-counter-main-title.active {
        color: #B71E1E;
    }

    @media all and (max-width: 767px) {
        #bellance-box {

            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            border-bottom-left-radius: 0px;
        }
    }

    .speedometer {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        position: relative;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
    }

    .speedometer svg {
        height: 130px;
        -o-object-fit: contain;
        object-fit: contain;
        width: 200px;
    }

    .speedometer svg path {
        fill: #E0E7FF;
    }

    .speedometer .score-data {
        margin-top: 60px;
        text-align: center;
        position: absolute;
    }

    .speedometer .score-data h3 {
        font-weight: 700;
        font-size: 42.9077px;
        line-height: 50px;
        text-align: center;
        letter-spacing: -0.536346px;
        color: #0C2434;
    }

    .speedometer .score-data span {
        font-weight: 400;
        font-size: 12px;
        line-height: 14px;
        text-align: center;
        letter-spacing: 1.08461px;
        text-transform: uppercase;
        color: #8798AD;
    }
</style>
<script>
    // sort table
    cPrev = -1; // global var saves the previous c, used to
                // determine if the same column is clicked again

    function sortBy(c) {
        rows = document.getElementById("sortable").rows.length; // num of rows
        columns = document.getElementById("sortable").rows[0].cells.length; // num of columns
        arrTable = [...Array(rows)].map(e => Array(columns)); // create an empty 2d array

        for (ro = 0; ro < rows; ro++) { // cycle through rows
            for (co = 0; co < columns; co++) { // cycle through columns
                // assign the value in each row-column to a 2d array by row-column
                arrTable[ro][co] = document.getElementById("sortable").rows[ro].cells[co].innerHTML;
            }
        }

        th = arrTable.shift(); // remove the header row from the array, and save it

        if (c !== cPrev) { // different column is clicked, so sort by the new column
            arrTable.sort(
                function (a, b) {
                    if (a[c] === b[c]) {
                        return 0;
                    } else {
                        return (a[c] < b[c]) ? -1 : 1;
                    }
                }
            );
        } else { // if the same column is clicked then reverse the array
            arrTable.reverse();
        }

        cPrev = c; // save in previous c

        arrTable.unshift(th); // put the header back in to the array

        // cycle through rows-columns placing values from the array back into the html table
        for (ro = 0; ro < rows; ro++) {
            for (co = 0; co < columns; co++) {
                document.getElementById("sortable").rows[ro].cells[co].innerHTML = arrTable[ro][co];
            }
        }
    }

    // sort table over

    //score js
    const secondFrameStart = 6000;
    const timeOnFrame = 3000;
    const startDeg = -90;
    const degRange = 180;
    let tickArray = [];
    let guageFrame = 0;
    let rgbRedValue = (12, 36, 52, 1);
    let x;

    // t: current time, b: begInnIng value, c: change In value, d: duration
    function easeInOutCubic(t, b, c, d) {
        if ((t /= d / 2) < 1) return c / 2 * t * t + b;
        return -c / 2 * ((--t) * (t - 2) - 1) + b;
    }

    function spawnColor(iter) {
        this.goFrames = 0;
        this.color = rgbRedValue;
        this.iteration = iter;
        this.fillColor = function () {
            if (this.goFrames <= 20) {
                var $el = document.querySelector('.js-guage-svg > path:nth-child(' + String(this.iteration) + ')');
                document.querySelector('.js-guage-svg > path:nth-child(' + String(this.iteration) + ')').style.fill = 'rgb(' + rgbRedValue + ',' + this.color + ',' + this.color + ')';
                this.color = this.color - (rgbRedValue / 20);
                this.goFrames = this.goFrames + 1;
                this.reqAnim = requestAnimationFrame(this.fillColor.bind(this));
            } else {
                this.goFrames = 0;
                this.color = rgbRedValue;
                cancelAnimationFrame(this.reqAnim);
            }
        };
    }

    function engageGuage() {
        let totalFrames = 100;
        let currChild = 0;
        let reqGuage;


        if (guageFrame < totalFrames && guageFrame < 83) {
            var deg = startDeg + easeInOutCubic(guageFrame, 0, degRange, totalFrames);
            console.log(deg)
            var iteration = Math.floor(easeInOutCubic(guageFrame, 0, document.querySelectorAll('.js-guage-svg > path').length + 1, totalFrames));
            document.querySelector('.js-needle').style.transform = 'rotateZ(' + deg + 'deg)';
            if (currChild != iteration) {
                tickArray[iteration] = new spawnColor(iteration);
                tickArray[iteration].fillColor();
                currChild = iteration;
            }
            guageFrame++;
            reqGuage = requestAnimationFrame(engageGuage);
        } else {
            guageFrame = 0;
            cancelAnimationFrame(reqGuage);
            // setTimeout( reset, 1000 );
            clearTimeout(x)
        }

    }

    function reset() {
        Array.prototype.forEach.call(document.querySelectorAll('.js-guage-svg > path'), function (el, i) {
            el.style.fill = '';
        });
        document.querySelector('.js-needle').style.transform = 'rotateZ(' + startDeg + 'deg)';
        tickArray = [];
        x = setTimeout(engageGuage, 1000);

    }

    reset();
    //score js over
</script>