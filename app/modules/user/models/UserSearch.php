<?php

namespace app\modules\user\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\user\models\User;

/**
 * UserSearch represents the model behind the search form of `app\modules\user\models\User`.
 */
class UserSearch extends User
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nu_use_lim', 'id_num_cbo', 'bo_use_log', 'status', 'user_level', 'created_at', 'updated_at'], 'integer'],
            [[
                'nm_use_log', 'username', 'name', 'nu_num_ide', 'nu_num_cpf', 'nu_num_cbo', 'nu_num_mat',
                'bi_arq_ava', 'auth_key', 'password_hash', 'password_reset_token', 'email'
            ], 'safe'],
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
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'bo_use_log' => $this->bo_use_log,
            'nu_use_lim' => $this->nu_use_lim,
            'nu_use_cont_log' => $this->nu_use_cont_log,
            'id_num_cbo' => $this->id_num_cbo,
            'status' => $this->status,
            'user_level' => $this->user_level,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'nm_use_log', $this->nm_use_log])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'nu_num_ide', $this->nu_num_ide])
            ->andFilterWhere(['like', 'nu_num_cpf', $this->nu_num_cpf])
            ->andFilterWhere(['like', 'nu_num_mat', $this->nu_num_mat])
            ->andFilterWhere(['like', 'bi_arq_ava', $this->bi_arq_ava])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
