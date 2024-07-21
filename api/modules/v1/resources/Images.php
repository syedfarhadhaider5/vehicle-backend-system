<?php

namespace api\modules\v1\resources;

use yii\helpers\Url;
use yii\web\Link;
use yii\web\Linkable;

/**
 * @author Ali Assad
 */
class Images extends \common\models\Images implements Linkable
{

    public function fields()
    {
        return ['id', 'vehicle_id','image_path','is_banner','created_at'];
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
            Link::REL_SELF => Url::to(['image/view', 'id' => $this->id], true)
        ];
    }

}
