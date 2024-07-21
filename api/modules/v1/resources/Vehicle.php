<?php

namespace api\modules\v1\resources;

use yii\helpers\Url;
use yii\web\Link;
use yii\web\Linkable;

/**
 * @author Ali Assad
 */
class Vehicle extends \common\models\Vehicle implements Linkable
{


    public function fields()
    {
        $fields = parent::fields();
        $fields['chat_user_id'] = function ($model) {
            $dealership_id = $model->dealership_id;
            $chat_user_id = 0;
            $dealership = \common\models\Dealership::findOne($dealership_id);
            if ($dealership) {
                $chat_user = $dealership->getUser()->one();
                if ($chat_user) {
                    $chat_user_id = $chat_user->chat_user_id;
                }
            }
            return $chat_user_id;
        };
        return $fields;
    }

    public function extraFields()
    {
        return ['vehicleMake', 'vehicleModel', 'images', 'saveCount', 'viewCount', 'dealership'];
    }

    /**
     * Returns a list of links.
     *
     * @return array the links
     */
    public function getLinks()
    {
        return [
            Link::REL_SELF => Url::to(['vehicle/view', 'id' => $this->id], true)
        ];
    }
}
