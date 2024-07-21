<?php

namespace api\modules\v1\resources;

use yii\helpers\Url;
use yii\web\Link;
use yii\web\Linkable;

/**
 * @author Ali Assad
 */
class Make extends \common\models\Make implements Linkable
{

    public function fields()
    {
        return ['id', 'title'];
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
            Link::REL_SELF => Url::to(['make/view', 'id' => $this->id], true)
        ];
    }

}
