<?php

namespace app\modules\api\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\api\models\Agenda;

/**
 * AgendaSearch represents the model behind the search form of `app\modules\agenda\models\Agenda`.
 */
class AgendaSearch extends Agenda
{
    /**
     * {@inheritdoc}
     */

    public $cidadao, $assunto, $state;

    public function rules()
    {
        return [
            [['id_num_age', 'bo_reg_exc', 'id_num_ass', 'id_num_sta',/* 'bo_eve_sta', */ 'id_num_cri', 'id_num_mod'], 'integer'],
            [['nm_nom_cid', 'nu_num_cpf', 'dt_age_dat', 'ti_age_hor', 'nm_nom_obs', 'dt_tim_cri', 'dt_tim_mod', 'cidadao', 'assunto', 'state'], 'safe'],
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
        $query = Agenda::find()
            ->orderBy('dt_age_dat', 'ti_age_hor');
        $query->andFilterWhere(['bo_reg_exc' => 0]);;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort(['defaultOrder' => ['dt_age_dat' => SORT_ASC, 'ti_age_hor' => SORT_ASC]]);

        $dataProvider->sort->attributes['cidadao'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['user.name' => SORT_ASC],
            'desc' => ['user.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['assunto'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['ger_assunto.nm_nom_ass' => SORT_ASC],
            'desc' => ['ger_assunto.nm_nom_ass' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['state'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['ger_state.nm_des_sta' => SORT_ASC],
            'desc' => ['ger_state.nm_des_sta' => SORT_DESC],
        ];

        $query->joinWith(['numCri', 'numAss', 'numSta'], 'RIGHT JOIN');
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_num_age' => $this->id_num_age,
            'bo_reg_exc' => $this->bo_reg_exc,
            //'id_num_ass' => $this->id_num_ass,
            //'bo_eve_sta' => $this->bo_eve_sta,
            /* 'dt_age_dat' => $this->dt_age_dat, */
            'id_num_cri' => $this->id_num_cri,
            'dt_tim_cri' => $this->dt_tim_cri,
            'id_num_mod' => $this->id_num_mod,
            'dt_tim_mod' => $this->dt_tim_mod,
        ]);

        $query
            ->andFilterWhere(['like', 'nm_nom_cid', $this->nm_nom_cid])
            //->andFilterWhere(['like', 'user.name', $this->cidadao])
            ->andFilterWhere(['like', 'ti_age_hor', $this->ti_age_hor])
            ->andFilterWhere(['like', 'ger_assunto.nm_nom_ass', $this->assunto])
            ->andFilterWhere(['like', 'ger_state.nm_des_sta', $this->state])
            ->andFilterWhere(['like', 'nm_nom_obs', $this->nm_nom_obs]);

        if ($this->dt_age_dat !== '' && !is_null($this->dt_age_dat)) {
            $query->andFilterWhere(['=', 'DATE_FORMAT(dt_age_dat,"%Y-%m-%d")', date('Y-m-d', strtotime($this->dt_age_dat))]);
        }

        return $dataProvider;
    }
}
