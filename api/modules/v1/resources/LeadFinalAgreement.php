<?php

namespace api\modules\v1\resources;

use yii\helpers\Url;
use yii\web\Link;
use yii\web\Linkable;

/**
 * @author Ali Assad
 */
class LeadFinalAgreement extends \common\models\LeadFinalAgreement implements Linkable
{

    public function extraFields()
    {
    }

    /**
     * Returns a list of links.
     *
     * @return array the links
     */
    public function getLinks()
    {
        return [
            Link::REL_SELF => Url::to(['lead-final-document/view', 'id' => $this->id], true)
        ];
    }
}
