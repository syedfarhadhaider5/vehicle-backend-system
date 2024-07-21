<?php

namespace api\modules\v1\controllers;
use api\modules\v1\models\Status;
use common\models\User;
use yii\rest\ActiveController;


/**
 * @author Ali Assad <aassad@autocenter.com>
 */
class UserController extends ActiveController
{
    /**
     * @var string
     */
    public $modelClass = 'api\modules\v1\resources\User';

    public function actionLogin()
    {
        $params = \Yii::$app->request->post();
        if (empty($params['username']) || empty($params['password'])) return [
            'status' => Status::STATUS_BAD_REQUEST,
            'message' => "Need email and password.",
            'data' => ''
        ];

        $user = User::find()->where(['email' => $params['username']])->one();
        if (!$user) {
            \ Yii::$app->response->statusCode = Status::STATUS_UNAUTHORIZED;
            \Yii::$app->response->format = \Yii::$app->response::FORMAT_JSON;
            return [
                'status' => Status::STATUS_UNAUTHORIZED,
                'message' => 'Email and Password not found. Check Again!',
                'data' => ''
            ];
        }

        if ($user->validatePassword($params['password'])) {
            if (isset($params['consumer'])) $user->consumer = $params['consumer'];
            if (isset($params['access_given'])) $user->access_given = $params['access_given'];

            \Yii::$app->response->statusCode = Status::STATUS_FOUND;
            \Yii::$app->response->format = \Yii::$app->response::FORMAT_JSON;
            $user->save();
            return [
                'status' => Status::STATUS_FOUND,
                'message' => 'Login Succeed, save your token',
                'data' => [
                    'id' => $user->id,
                    'token' => $user->access_token,
                    'name' => $user->getUserProfile()->one()->firstname . ' ' . $user->getUserProfile()->one()->lastname,
                    'email' => $user['email'],
                ]
            ];
        } else {
            \ Yii::$app->response->statusCode = Status::STATUS_UNAUTHORIZED;
            \Yii::$app->response->format = \Yii::$app->response::FORMAT_JSON;
            return [
                'status' => Status::STATUS_UNAUTHORIZED,
                'message' => 'Email and Password not found. Check Again!',
                'data' => ''
            ];
        }
    }

    public function actionSignUp()
    {
        $params = \Yii::$app->request->post();
        if (empty($params['first_name'])
            || empty($params['last_name'])
            || empty($params['email'])
            || empty($params['password'])
        ) return [
            'status' => Status::STATUS_BAD_REQUEST,
            'message' => "Need first_name, last_name, email  and password.",
            'data' => ''
        ];

        $user = User::find()->where(['email' => $params['email']])->one();
        if ($user) {
            return [
                'status' => Status::STATUS_FORBIDDEN,
                'message' => "User already exist with this email.",
                'data' => ''
            ];
        }

        if (!$user) {
            $user = new User();
            $user->username = $params['email'];
            $user->email = $params['email'];
            $user->setPassword($params['password']);
            $user->save();
            $params['user_id'] = $user->id;
            $user->afterSignup($params);
            \Yii::$app->response->statusCode = Status::STATUS_CREATED;
            \Yii::$app->response->format = \Yii::$app->response::FORMAT_JSON;

            return [
                'status' => Status::STATUS_CREATED,
                'message' => 'New Account Created, save your token',
                'data' => [
                    'id' => $user->id,
                    'token' => $user->access_token,
                    'name' => $user->getUserProfile()->one()->firstname . ' ' . $user->getUserProfile()->one()->lastname,
                    'email' => $user['email'],
                ]
            ];
        }
    }


    public function actionResetPassword($token)
    {
        $model=new User();
        $model=$model->resetToken($token);
        if(isset($_POST['password']))
        {
            if($model->reset_token==$token){
                $model->setPassword($_POST['password']);
                $model->reset_token="null";
                $model->save();
                return 'Password Reset ';
            }
        }
         return 'Password Reset failed';
    }
    public function actionForgot()
    {
        $getEmail=$_GET['email'];
        $getModel= User::find()->where(array('email'=>$getEmail))->one();
        if(isset($_GET['email']))
        {
            $getToken= generateRandomString();
            $getModel->reset_token=md5($getToken);
            $userName=$getModel->username;
            $adminEmail=$getModel->email;
            $subject="Reset Password";
            $emailBody="you have successfully reset your password<br/>
                    <a href='http://localhost/auto-center-yii2-app/api/web/v1/user/reset-password?token=".$getModel->reset_token."'>Click Here to Reset Password</a>";
            // TODO http://api.admin.autocenter.com/v1/user/reset-password?token=".$getModel->reset_token."
            // TODO http://dev.autocenter.com/change-password?token=$getModel->reset_token
            if($getModel->validate())
            {
                $getModel->save();
                if(sendEmail($adminEmail,$getEmail,$emailBody,$userName,$subject))
                {
                    return 'link to reset your password has been sent to your email' .$userName;
                    $this->refresh();
                }
                else
                {
                    return 'Email Sending Failed... Pleas Try again later.';
                }

            }
        }
        else
        {
            return 'Invalid Credentials... Please try again.';
        }
    }
    public function actionChangePassword($id)
    {
        $user=User::findOne($id);
        if($user->validatePassword($_POST['oldPassword']))
        {
            $user->setPassword($_POST['newPassword']);
            $user->save();
            return "success";
        }
        else{
            return "error";
        }
    }
}
