<?php

namespace backend\models\search;

use common\models\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * DealersSearch represents the model behind the search form about `common\models\User`.
 */
class DealersSearch extends User
{

    public $role;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['created_at', 'updated_at', 'logged_at', 'role', 'dealership_id'], 'default', 'value' => null],
            [['username', 'auth_key', 'password_hash', 'email'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     * @return ActiveDataProvider
     */
    public function search($params)
    {



        if (!($this->load($params) && $this->validate())) {
            $query = User::find()->join('LEFT JOIN', 'rbac_auth_assignment', 'rbac_auth_assignment.user_id = id')
                ->andFilterWhere(['rbac_auth_assignment.item_name' => "DEALERSHIP_ADMIN"])
                ->orFilterWhere(['rbac_auth_assignment.item_name' => "DEALERSHIP_MANAGER"])
                ->orFilterWhere(['rbac_auth_assignment.item_name' => "DEALERSHIP_SALE_REP"])
                ->andFilterWhere(['=', 'dealership_id', \Yii::$app->getUser()->getIdentity()->id]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
            return $dataProvider;
        }
        else{
            $query = User::find()->join('LEFT JOIN', 'rbac_auth_assignment', 'rbac_auth_assignment.user_id = id')
                ->andFilterWhere(['=', 'dealership_id', \Yii::$app->getUser()->getIdentity()->id]);
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
        }
        if($this->role)
        {
            $query->andFilterWhere(['rbac_auth_assignment.item_name' => $this->role]);
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        echo $query->createCommand()->rawSql;

        if ($this->created_at !== null) {
            $query->andFilterWhere(['between', 'created_at', strtotime($this->created_at), strtotime($this->created_at) + 3600 * 24]);
        }

        if ($this->updated_at !== null) {
            $query->andFilterWhere(['between', 'updated_at', strtotime($this->updated_at), strtotime($this->updated_at) + 3600 * 24]);
        }

        if ($this->logged_at !== null) {
            $query->andFilterWhere(['between', 'logged_at', strtotime($this->logged_at), strtotime($this->logged_at) + 3600 * 24]);
        }


        if ($this->dealership_id) {
            $query->andFilterWhere(['=', 'dealership_id', $this->dealership_id]);
        }

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }

    public function searchList($params,$id)
    {



        if (!($this->load($params) && $this->validate())) {
            $query = User::find()->join('LEFT JOIN', 'rbac_auth_assignment', 'rbac_auth_assignment.user_id = id')
                ->andFilterWhere(['rbac_auth_assignment.item_name' => "DEALERSHIP_ADMIN"])
                ->orFilterWhere(['rbac_auth_assignment.item_name' => "DEALERSHIP_MANAGER"])
                ->orFilterWhere(['rbac_auth_assignment.item_name' => "DEALERSHIP_SALE_REP"])
                ->andFilterWhere(['=', 'dealership_id', $id]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
            return $dataProvider;
        }
        else{
            $query = User::find()->join('LEFT JOIN', 'rbac_auth_assignment', 'rbac_auth_assignment.user_id = id')
                ->andFilterWhere(['=', 'dealership_id', $id]);
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
        }
        if($this->role)
        {
            $query->andFilterWhere(['rbac_auth_assignment.item_name' => $this->role]);
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        echo $query->createCommand()->rawSql;

        if ($this->created_at !== null) {
            $query->andFilterWhere(['between', 'created_at', strtotime($this->created_at), strtotime($this->created_at) + 3600 * 24]);
        }

        if ($this->updated_at !== null) {
            $query->andFilterWhere(['between', 'updated_at', strtotime($this->updated_at), strtotime($this->updated_at) + 3600 * 24]);
        }

        if ($this->logged_at !== null) {
            $query->andFilterWhere(['between', 'logged_at', strtotime($this->logged_at), strtotime($this->logged_at) + 3600 * 24]);
        }


        if ($this->dealership_id) {
            $query->andFilterWhere(['=', 'dealership_id', $this->dealership_id]);
        }

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }

}
