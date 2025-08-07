<?php

namespace app\modules\fun\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\fun\models\Funcionarios;

/**
 * FuncionariosSearch represents the model behind the search form of `app\modules\fun\models\Funcionarios`.
 */
class FuncionariosSearch extends Funcionarios
{

    public $unidade, $cargo, $funcao, $regime, $cargahora;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[
                'id_num_fun', 'id_num_uni', 'id_num_car', 'id_num_fuc', 'id_num_reg',
                'id_car_hor', 'id_num_cri', 'id_num_mod'
            ], 'integer'],
            [[
                'nu_mat_fun', 'nm_nom_fun', 'dt_nas_fun', 'nu_cpf_fun', 'nu_ide_fun',
                'nm_nom_mae', 'nm_nom_pai', 'nm_nom_ema', 'nu_num_cep', 'nm_nom_log',
                'nu_num_cas', 'nm_nom_com', 'nm_nom_bai', 'nm_nom_mun', 'nm_nom_est',
                'nu_num_tel', 'nu_num_tel_1', 'dt_tim_cri', 'dt_tim_mod'
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
        $query = Funcionarios::find();
        $query->andFilterWhere(['funcionarios.bo_reg_exc' => 0]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        $dataProvider->sort->attributes['unidade'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['unidades.nm_nom_uni' => SORT_ASC],
            'desc' => ['unidades.nm_nom_uni' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['cargo'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['cargos.nm_des_car' => SORT_ASC],
            'desc' => ['cargos.nm_des_car' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['funcao'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['funcoes.nm_des_fuc' => SORT_ASC],
            'desc' => ['funcoes.nm_des_fuc' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['regime'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['regimes.nm_des_reg' => SORT_ASC],
            'desc' => ['regimes.nm_des_reg' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['cargahora'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['cargaHorarias.nu_car_hor' => SORT_ASC],
            'desc' => ['cargaHorarias.nu_car_hor' => SORT_DESC],
        ];

        $query->joinWith(['numUni', 'numCar', 'numFuc', 'numReg', 'numHor',], 'RIGHT JOIN');

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_num_fun' => $this->id_num_fun,
            'dt_nas_fun' => $this->dt_nas_fun,
            'id_num_uni' => $this->id_num_uni,
            'id_num_car' => $this->id_num_car,
            'id_num_fuc' => $this->id_num_fuc,
            'id_num_reg' => $this->id_num_reg,
            'id_car_hor' => $this->id_car_hor,
            'dt_tim_cri' => $this->dt_tim_cri,
            'id_num_cri' => $this->id_num_cri,
            'dt_tim_mod' => $this->dt_tim_mod,
            'id_num_mod' => $this->id_num_mod,
        ]);

        $query->andFilterWhere(['like', 'nu_mat_fun', $this->nu_mat_fun])
            ->andFilterWhere(['like', 'nm_nom_fun', $this->nm_nom_fun])
            ->andFilterWhere(['like', 'nu_cpf_fun', $this->nu_cpf_fun])
            ->andFilterWhere(['like', 'nu_ide_fun', $this->nu_ide_fun])
            ->andFilterWhere(['like', 'nm_nom_mae', $this->nm_nom_mae])
            ->andFilterWhere(['like', 'nm_nom_pai', $this->nm_nom_pai])
            ->andFilterWhere(['like', 'nm_nom_ema', $this->nm_nom_ema])
            ->andFilterWhere(['like', 'nu_num_cep', $this->nu_num_cep])
            ->andFilterWhere(['like', 'nm_nom_log', $this->nm_nom_log])
            ->andFilterWhere(['like', 'nu_num_cas', $this->nu_num_cas])
            ->andFilterWhere(['like', 'nm_nom_com', $this->nm_nom_com])
            ->andFilterWhere(['like', 'nm_nom_bai', $this->nm_nom_bai])
            ->andFilterWhere(['like', 'nm_nom_mun', $this->nm_nom_mun])
            ->andFilterWhere(['like', 'nm_nom_est', $this->nm_nom_est])
            ->andFilterWhere(['like', 'nu_num_tel', $this->nu_num_tel])
            ->andFilterWhere(['like', 'nu_num_tel_1', $this->nu_num_tel_1])
            ->andFilterWhere(['like', 'unidades.nm_nom_uni', $this->unidade])
            ->andFilterWhere(['like', 'cargos.nm_des_car', $this->cargo])
            ->andFilterWhere(['like', 'funcoes.nm_des_fuc', $this->funcao])
            ->andFilterWhere(['like', 'regimes.nm_des_reg', $this->regime])
            ->andFilterWhere(['like', 'cargaHorarias.nu_car_hor', $this->cargahora]);

        return $dataProvider;
    }
}
