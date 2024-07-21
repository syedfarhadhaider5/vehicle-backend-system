<?php

namespace api\modules\v1\resources;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class UserProfile extends \common\models\UserProfile
{

    public function extraFields()
    {
        return ['user'];
    }
}
