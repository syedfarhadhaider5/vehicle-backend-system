<?php

namespace api\modules\v1\resources;

use yii\helpers\Url;
use yii\web\Link;
use yii\web\Linkable;

/**
 * @author Ali Assad
 */
class LeadTerm extends \common\models\LeadTerm implements Linkable
{

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
            Link::REL_SELF => Url::to(['lead-term/view', 'id' => $this->id], true)
        ];
    }
}
