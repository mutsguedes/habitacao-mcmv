<?php

namespace app\modules\ava\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\ava\models\EmailAvaliacao;

/**
 * EmailAvaliacaoSearch represents the model behind the search form of `app\modules\ava\models\EmailAvaliacoes`.
 */
class EmailAvaliacaoSearch extends EmailAvaliacao
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ema_ava', 'id_num_ema', 'nu_ava_est', 'id_num_cri', 'id_num_mod', 'dt_tim_mod'], 'integer'],
            [['nm_ava_com', 'dt_tim_cri'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = EmailAvaliacao::find();

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
            'id_ema_ava' => $this->id_ema_ava,
            'id_num_ema' => $this->id_num_ema,
            'nu_ava_est' => $this->nu_ava_est,
            'id_num_cri' => $this->id_num_cri,
            'dt_tim_cri' => $this->dt_tim_cri,
            'id_num_mod' => $this->id_num_mod,
            'dt_tim_mod' => $this->dt_tim_mod,
        ]);

        $query->andFilterWhere(['like', 'nm_ava_com', $this->nm_ava_com]);

        return $dataProvider;
    }
}
