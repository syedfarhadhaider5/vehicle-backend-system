<?php

namespace api\modules\v1\resources;

use yii\helpers\Url;
use yii\web\Link;
use yii\web\Linkable;

/**
 * @author Ali Assad
 */
class Offer extends \common\models\Lead implements Linkable
{

    public function extraFields()
    {
        return ['vehicle'];
    }

    /**
     * Returns a list of links.
     *
     * @return array the links
     */
    public function getLinks()
    {
        return [
            Link::REL_SELF => Url::to(['lead/view', 'id' => $this->id], true)
        ];
    }
}
