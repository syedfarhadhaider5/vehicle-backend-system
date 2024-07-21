<?php

namespace api\modules\v1\resources;

use yii\helpers\Url;
use yii\web\Link;
use yii\web\Linkable;

/**
 * @author Ali Assad
 */
class SavedVehicle extends \common\models\SavedVehicle implements Linkable
{

    public function extraFields()
    {
        return ['user','vehicle'];
    }
    /**
     * Returns a list of links.
     *
     * @return array the links
     */
    public function getLinks()
    {
        return [
            Link::REL_SELF => Url::to(['saved-vehicle/view', 'id' => $this->id], true)
        ];
    }
}

?>