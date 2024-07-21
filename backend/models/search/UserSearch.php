<?php

namespace backend\models\search;

use common\models\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class UserSearch extends User
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
    public function search($params,$type)
    {
        if (\Yii::$app->getUser()->getIdentity()->dealership_id) {
            $query = User::find()->where(['dealership_id' => \Yii::$app->getUser()->getIdentity()->dealership_id]);
        } else {
            $query = User::find();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        if ($this->created_at !== null) {
            $query->andFilterWhere(['between', 'created_at', strtotime($this->created_at), strtotime($this->created_at) + 3600 * 24]);
        }

        if ($this->updated_at !== null) {
            $query->andFilterWhere(['between', 'updated_at', strtotime($this->updated_at), strtotime($this->updated_at) + 3600 * 24]);
        }

        if ($this->logged_at !== null) {
            $query->andFilterWhere(['between', 'logged_at', strtotime($this->logged_at), strtotime($this->logged_at) + 3600 * 24]);
        }

        if ($this->role) {
            $query->join('LEFT JOIN', 'rbac_auth_assignment', 'rbac_auth_assignment.user_id = id')
                ->andFilterWhere(['rbac_auth_assignment.item_name' => $this->role]);
        }
        if($type=="USER" && !$this->role)
        {
            $query->join('LEFT JOIN', 'rbac_auth_assignment', 'rbac_auth_assignment.user_id = id')
                ->andFilterWhere(['rbac_auth_assignment.item_name' => "USER"]);
        }
        else if($type=="ADMIN" && !$this->role)
        {
            $query->join('LEFT JOIN', 'rbac_auth_assignment', 'rbac_auth_assignment.user_id = id')
                ->andFilterWhere(['rbac_auth_assignment.item_name' =>"AC_ADMIN"])
                ->OrFilterWhere(['rbac_auth_assignment.item_name' =>"AC_ACCOUNT_REP"]);
        }
        else if($type=="DEALER" && !$this->role)
        {
            $query->join('LEFT JOIN', 'rbac_auth_assignment', 'rbac_auth_assignment.user_id = id')
                ->OrFilterWhere(['rbac_auth_assignment.item_name' =>"DEALERSHIP_ADMIN"]);
        }
        else{}


        if ($this->dealership_id) {
            $query->andFilterWhere(['=', 'dealership_id', $this->dealership_id]);
        }

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'email', $this->email]);

//echo $query->createCommand()->rawSql."<br>";
        return $dataProvider;
    }


}
