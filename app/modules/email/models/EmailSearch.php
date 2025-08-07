<?php

namespace app\modules\email\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\email\models\Email;

/**
 * EmailsSearch represents the model behind the search form of `app\modules\email\models\Emails`.
 */
class EmailSearch extends Email
{
    public $protocolo, $assunto, $nomeuse, $emailuse, $cpfuse, $emasit;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_num_ema', 'bo_ema_ava', 'bo_ema_fin', 'id_ema_ass', 'id_pag_usu', 'id_ema_sit', 'id_num_cri', 'id_num_mod'], 'integer'],
            [[
                'nu_num_seq', 'nu_num_num', 'nm_men_ema', 'dt_ema_man', 'dt_tim_cri', 'dt_tim_mod',
                'protocolo', 'assunto', 'nomeuse', 'emailuse', 'cpfuse', 'emasit'
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
        $query = Email::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort(['defaultOrder' => ['nu_num_seq' => SORT_ASC]]);


        $dataProvider->sort->attributes['assunto'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['emailAssunto.nm_ema_ass' => SORT_ASC],
            'desc' => ['emailAssunto.nm_ema_ass' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['emasit'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['emailSituacao.nm_ema_sit' => SORT_ASC],
            'desc' => ['emailSituacao.nm_ema_sit' => SORT_DESC],
        ];

        $query->joinWith(['emaAss', 'emaSit'], 'RIGHT JOIN');

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_num_ema' => $this->id_num_ema,
            'bo_ema_ava' => $this->bo_ema_ava,
            'bo_ema_fin' => $this->bo_ema_fin,
            //            'id_ema_ass' => $this->id_ema_ass,
            'id_pag_usu' => $this->id_pag_usu,
            //            'id_ema_sit' => $this->id_ema_sit,
            'dt_ema_man' => $this->dt_ema_man,
            'id_num_cri' => $this->id_num_cri,
            'dt_tim_cri' => $this->dt_tim_cri,
            'id_num_mod' => $this->id_num_mod,
            'dt_tim_mod' => $this->dt_tim_mod,
        ]);

        $query->andFilterWhere(['like', 'emailAssunto.nm_ema_ass', $this->assunto])
            ->andFilterWhere(['like', 'emailSituacao.nm_ema_sit', $this->emasit])
            ->andFilterWhere(['like', 'nu_num_seq', $this->nu_num_seq])
            ->andFilterWhere(['like', 'nu_num_num', $this->nu_num_num])
            ->andFilterWhere(['like', 'nm_men_ema', $this->nm_men_ema]);

        return $dataProvider;
    }
}
