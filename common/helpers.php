<?php
/**
 * Yii2 Shortcuts
 * @author Eugene Terentev <eugene@terentev.net>
 * @author Ali Assad <aassad@autocenter.com>
 * -----
 * This file is just an example and a place where you can add your own shortcuts,
 * it doesn't pretend to be a full list of available possibilities
 * -----
 */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * @return int|string
 */
function getMyId()
{
    return Yii::$app->user->getId();
}

/**
 * @param string $view
 * @param array $params
 * @return string
 */
function render($view, $params = [])
{
    return Yii::$app->controller->render($view, $params);
}

/**
 * @param $url
 * @param int $statusCode
 * @return \yii\web\Response
 */
function redirect($url, $statusCode = 302)
{
    return Yii::$app->controller->redirect($url, $statusCode);
}

/**
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
function env($key, $default = null)
{
    // getenv is disabled when using createImmutable with Dotenv class
    if (isset($_ENV[$key])) {
        return $_ENV[$key];
    } elseif (isset($_SERVER[$key])) {
        return $_SERVER[$key];
    }

    return $default;
}

/**
 * Renders any data provider summary text.
 *
 * @param \yii\data\DataProviderInterface $dataProvider
 * @param array $options the HTML attributes for the container tag of the summary text
 * @return string the HTML summary text
 */
function getDataProviderSummary($dataProvider, $options = [])
{
    $count = $dataProvider->getCount();
    if ($count <= 0) {
        return '';
    }
    $tag = ArrayHelper::remove($options, 'tag', 'div');
    if (($pagination = $dataProvider->getPagination()) !== false) {
        $totalCount = $dataProvider->getTotalCount();
        $begin = $pagination->getPage() * $pagination->pageSize + 1;
        $end = $begin + $count - 1;
        if ($begin > $end) {
            $begin = $end;
        }
        $page = $pagination->getPage() + 1;
        $pageCount = $pagination->pageCount;
        return Html::tag($tag, Yii::t('yii', 'Showing <b>{begin, number}-{end, number}</b> of <b>{totalCount, number}</b> {totalCount, plural, one{item} other{items}}.', [
            'begin' => $begin,
            'end' => $end,
            'count' => $count,
            'totalCount' => $totalCount,
            'page' => $page,
            'pageCount' => $pageCount,
        ]), $options);
    } else {
        $begin = $page = $pageCount = 1;
        $end = $totalCount = $count;
        return Html::tag($tag, Yii::t('yii', 'Total <b>{count, number}</b> {count, plural, one{item} other{items}}.', [
            'begin' => $begin,
            'end' => $end,
            'count' => $count,
            'totalCount' => $totalCount,
            'page' => $page,
            'pageCount' => $pageCount,
        ]), $options);
    }
}

function calHours($time1, $time2)
{
    $diff = abs(strtotime($time1) - strtotime($time2));
    $tmins = $diff / 60;
    $hours = floor($tmins / 60);
    $mins = $tmins % 60;
    return "<b>$hours</b>h,<b>$mins</b>min</b>";
}


function getEnumItems($model, $attribute)
{
    $attr = $attribute;
    preg_match('/\((.*)\)/', $model->tableSchema->columns[$attr]->dbType, $matches);
    foreach (explode("','", $matches[1]) as $value) {
        $value = str_replace("'", null, $value);
        $values[$value] = \Yii::t('enumItem', $value);
    }
    return $values;
}
function generateRandomString($length = 20) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}
function sendEmail($senderEmail,$receiverEmail,$body,$senderName,$subject)
{
    $name='=?UTF-8?B?'.base64_encode($senderName).'?=';
    $subject='=?UTF-8?B?'.base64_encode($subject).'?=';
    $headers="From: $name <{$senderEmail}>\r\n".
        "Reply-To: {$senderEmail}\r\n".
        "MIME-Version: 1.0\r\n".
        "Content-type: text/html; charset=UTF-8";
    if(mail($receiverEmail,$subject,$body,$headers))
    {
       return 1;
    }
    else
    {
        return 0;
    }
}
function createChatUser($user, $profileData)
{
    $client = new \yii\httpclient\Client(['baseUrl' => env('CHAT_API_PATH')]);
    $name = $profileData['first_name'] . ' ' . $profileData['last_name'];
    if ($profileData['first_name']) {
        $chat_user_name = $name;
    } else {
        $chat_user_name = $user->username;
    }
    $response = $client->post('chatuser',
        [
            'name' => $chat_user_name,
            'email' => $user->email,
            'password' => $user->username,
            'access_token' => $user->access_token,
        ])
        ->addHeaders(['Content-Type' => 'application/json'])
        ->send();

    if ($response->getStatusCode() == 302 || $response->getStatusCode() == 200) {
        $chat_user_id = json_decode($response->content)->chat_user_id;
        $user = \common\models\User::findOne($user->id);
        $user->chat_user_id = $chat_user_id;
        $user->save(false);
    }

    return $response;
}