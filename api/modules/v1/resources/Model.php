<?php

namespace api\modules\v1\resources;

use yii\helpers\Url;
use yii\web\Link;
use yii\web\Linkable;

/**
 * @author Ali Assad
 */
class Model extends \common\models\Model implements Linkable
{
    public function fields()
    {
        return ['id', 'title','year','make_id','created_at'];
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
            Link::REL_SELF => Url::to(['model/view', 'id' => $this->id], true)
        ];
    }
}

?>