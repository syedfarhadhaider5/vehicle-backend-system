<?php

namespace api\modules\v1\resources;

use yii\helpers\Url;
use yii\web\Link;
use yii\web\Linkable;

/**
 * @author Ali Assad
 */
class VehicleView extends \common\models\VehicleView implements Linkable
{

    public function fields()
    {
        return ['id', 'user_ip','vehicle_id','created_at'];
    }

    public function extraFields()
    {
        return [];
    }
    /**
     * Returns a list of links.
     *
     * @return array the links
     */
    public function getLinks()
    {
        return [
            Link::REL_SELF => Url::to(['vehicle-view/view', 'id' => $this->id], true)
        ];
    }

}
