<?php

namespace app\modules\ocu\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\ocu\models\Ocupacao;

/**
 * OcupacoeSearch represents the model behind the search form of `app\modules\ocu\models\Ocupacao`.
 */
class OcupacaoSearch extends Ocupacao
{

    /**
     * {@inheritdoc}
     */
    public $responsavel, $quadra, $lote, $bloco, $apartamento;

    public function rules()
    {
        return [
            [['id_num_ocu', 'bo_reg_exc', 'id_num_res', 'id_num_apa', 'id_num_cri', 'id_num_mod'], 'integer'],
            [[
                'dt_ocu_apa', 'nm_nom_obs', 'nu_num_cpf', 'dt_tim_cri', 'dt_tim_mod', 'responsavel', 'quadra',
                'lote', 'bloco', 'apartamento'
            ], 'safe'],
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
        $query = Ocupacao::find();
        $query->andFilterWhere(['ocupacao.bo_reg_exc' => 0]);
        // $query = Ocupacoes::find()->where(['bo_reg_exc' => 0]);
        //$query = Ocupacoes::find(['bo_reg_exc' => 0]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['responsavel'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['responsavel.nm_nom_res' => SORT_ASC],
            'desc' => ['responsavel.nm_nom_res' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['quadra'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['apartamento.nu_num_qua' => SORT_ASC],
            'desc' => ['apartamento.nu_num_qua' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['lote'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['apartamento.nu_num_lot' => SORT_ASC],
            'desc' => ['apartamento.nu_num_lot' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['bloco'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['apartamento.nu_num_blo' => SORT_ASC],
            'desc' => ['apartamento.nu_num_blo' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['apartamento'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['apartamento.nu_num_apa' => SORT_ASC],
            'desc' => ['apartamento.nu_num_apa' => SORT_DESC],
        ];


        $query->joinWith(['numRes', 'numApa'], 'RIGHT JOIN');
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_num_ocu' => $this->id_num_ocu,
            'bo_reg_exc' => $this->bo_reg_exc,
            //'id_num_res' => $this->id_num_res,
            //'id_num_apa' => $this->id_num_apa,
            'id_num_cri' => $this->id_num_cri,
            'dt_tim_cri' => $this->dt_tim_cri,
            'id_num_mod' => $this->id_num_mod,
            'dt_tim_mod' => $this->dt_tim_mod,
        ]);

        $query->andFilterWhere(['like', 'responsavel.nm_nom_res', $this->responsavel])
            ->andFilterWhere(['like', 'apartamento.nu_num_qua', $this->quadra])
            ->andFilterWhere(['like', 'apartamento.nu_num_lot', $this->lote])
            ->andFilterWhere(['like', 'apartamento.nu_num_blo', $this->bloco])
            ->andFilterWhere(['like', 'apartamento.nu_num_apa', $this->apartamento])
            ->andFilterWhere(['like', 'id_con_ocu', $this->id_con_ocu])
            ->andFilterWhere(['like', 'nm_nom_obs', $this->nm_nom_obs]);

        return $dataProvider;
    }
}
