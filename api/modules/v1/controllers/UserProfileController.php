<?php

namespace api\modules\v1\controllers;
use api\modules\v1\models\Status;
use api\modules\v1\resources\UserProfile;
use common\models\User;
use yii\rest\ActiveController;
use Yii;
use yii\web\UploadedFile;

/**
 * @author Ali Assad <aassad@autocenter.com>
 */
class UserProfileController extends ActiveController
{
    /**
     * @var string
     */
    public $modelClass = 'api\modules\v1\resources\UserProfile';

    public function actionUpdateProfile($user_id)
    {
        $profile = UserProfile::findOne($user_id);

        if(Yii::$app->request->isPost) {
            $profile->avatar_path = UploadedFile::getInstanceByName('avatar_path');
            $profile->firstname = Yii::$app->request->post("firstname");
            $profile->lastname = Yii::$app->request->post("lastname");
            $profile->middlename = Yii::$app->request->post("middlename");
            if(isset($profile->avatar_path))
            {
                $profile->avatar_path = $profile->uploadAvatar();

            }
            $profile->gender = Yii::$app->request->post("gender");
            $profile->save(false);
            return ['success' => "profile save successfully"];
        }
    }
    public function actionGetUserProfile($user_id)
    {
        $profile = UserProfile::findOne($user_id);
        return ['user' => $profile];
    }

}
