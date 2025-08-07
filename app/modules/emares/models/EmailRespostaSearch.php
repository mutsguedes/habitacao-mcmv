<?php

namespace app\modules\emares\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\emares\models\EmailResposta;

/**
 * EmailRespostasSearch represents the model behind the search form of `app\modules\resposta\models\EmailRespostas`.
 */
class EmailRespostaSearch extends EmailResposta
{

    public $cidadao, $cpf, $descricao, $autor, $dataman;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ema_res', 'id_num_ema', 'id_ema_and', 'id_num_cri', 'id_num_mod'], 'integer'],
            [['nm_nom_resp', 'dt_tim_cri', 'dt_tim_mod', 'cidadao', 'cpf', 'descricao', 'autor', 'dataman'], 'safe'],
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
        $query = EmailResposta::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort(['defaultOrder' => ['id_ema_res' => SORT_ASC]]);


        /* $dataProvider->sort->attributes['cidadao'] = [
          // The tables are the ones our relation are configured to
          // in my case they are prefixed with "tbl_"
          'asc' => ['user.name' => SORT_ASC],
          'desc' => ['user.name' => SORT_DESC],
          ]; */

        $dataProvider->sort->attributes['dataman'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['email.dt_ema_man' => SORT_ASC],
            'desc' => ['email.dt_ema_man' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['descricao'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['emailAndamento.nm_ema_and' => SORT_ASC],
            'desc' => ['emailAndamento.nm_ema_and' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['autor'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['emailAndamento.nm_ema_and' => SORT_ASC],
            'desc' => ['emailAndamento.nm_ema_and' => SORT_DESC],
        ];

        $query->joinWith(['numEma', 'emaAnd'], 'RIGHT JOIN');

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_ema_res' => $this->id_ema_res,
            'id_ema_and' => $this->id_ema_and,
            'id_num_cri' => $this->id_num_cri,
            'dt_tim_cri' => $this->dt_tim_cri,
            'id_num_mod' => $this->id_num_mod,
            'dt_tim_mod' => $this->dt_tim_mod,
        ]);

        $query->andFilterWhere(['like', 'email.nm_nom_resp', $this->cidadao])
            ->andFilterWhere(['like', 'email.nu_num_cpf', $this->cpf])
            ->andFilterWhere(['like', 'nm_nom_resp', $this->nm_nom_resp]);

        return $dataProvider;
    }
}
