<?php

namespace app\modules\cli\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\cli\models\Mcmvws;

/**
 * McmvwsSearch represents the model behind the search form of `app\modules\cli\models\Mcmvws`.
 */
class McmvwsSearch extends Mcmvws
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_num_res', 'bo_reg_exc', 'bo_tec_soc', 'id_num_proj', 'id_cor_sit'], 'integer'],
            [['nm_ide_pes', 'nu_num_seq', 'nu_num_ins', 'id_con_ocu', 'dt_sor_res', 'nm_nom_res', 'dt_nas_res', 'nu_num_cpf', 'nm_nom_obs'], 'safe'],
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
        $query = Mcmvws::find();

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
            'id_num_res' => $this->id_num_res,
            'bo_reg_exc' => $this->bo_reg_exc,
            'bo_tec_soc' => $this->bo_tec_soc,
            'id_num_proj' => $this->id_num_proj,
            'id_cor_sit' => $this->id_cor_sit,
            'dt_sor_res' => $this->dt_sor_res,
            'dt_nas_res' => $this->dt_nas_res,
        ]);

        $query->andFilterWhere(['like', 'nm_ide_pes', $this->nm_ide_pes])
            ->andFilterWhere(['like', 'nu_num_seq', $this->nu_num_seq])
            ->andFilterWhere(['like', 'nu_num_ins', $this->nu_num_ins])
            ->andFilterWhere(['like', 'id_con_ocu', $this->id_con_ocu])
            ->andFilterWhere(['like', 'nm_nom_res', $this->nm_nom_res])
            ->andFilterWhere(['like', 'nu_num_cpf', $this->nu_num_cpf])
            ->andFilterWhere(['like', 'nm_nom_obs', $this->nm_nom_obs]);

        return $dataProvider;
    }
}
