<?php
/**
 * Created by PhpStorm.
 * User: aliassad
 */

namespace common\models\query;

use common\models\Vehicle;
use yii\db\ActiveQuery;

class VehicleQuery extends ActiveQuery
{
    /**
     * @return $this
     */
    public function published()
    {
        return $this;
    }

    public function getFullArchive()
    {
        return $this;
    }
}
