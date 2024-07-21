<?php

namespace api\modules\v1\resources;

use yii\helpers\Url;
use yii\web\Link;
use yii\web\Linkable;

/**
 * @author Ali Assad
 */
class CoSigner extends \common\models\CoSigner implements Linkable
{

    public function extraFields()
    {
        return ['CoSigner'];
    }

    /**
     * Returns a list of links.
     *
     * @return array the links
     */
    public function getLinks()
    {
        return [
            Link::REL_SELF => Url::to(['co-signer/view', 'id' => $this->id], true)
        ];
    }
}
