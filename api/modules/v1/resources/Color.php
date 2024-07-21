<?php

namespace api\modules\v1\resources;

use yii\helpers\Url;
use yii\web\Link;
use yii\web\Linkable;

/**
 * @author Ali Assad
 */
class Color extends \common\models\Color implements Linkable
{

    public function fields()
    {
        return ['id', 'title','name','code','created_at'];
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
            Link::REL_SELF => Url::to(['color/view', 'id' => $this->id], true)
        ];
    }

}
