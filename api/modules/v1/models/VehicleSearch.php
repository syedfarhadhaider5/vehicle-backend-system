<?php

namespace api\modules\v1\models;

use common\models\User;
use common\models\Vehicle;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class VehicleSearch extends Vehicle
{

    public $role;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title'], 'string'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Vehicle::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if ($this->id) {
            $query->select([new \yii\db\Expression('id, title')])
            ->andFilterWhere(['id', $this->id]);
        }

       // $query->orWhere(['like', 'title',  '%' . $this->title . '%', false]);
//        $dataProvider->sort->attributes['title'] = [
//            'asc' => ['title' => SORT_ASC]
//        ];

        if ($this->title != NULL) {
            $query->select([new \yii\db\Expression('id, title')])
                ->andFilterWhere(['like','title' ,$this->title ]);
        }
        return $dataProvider;
    }
}
