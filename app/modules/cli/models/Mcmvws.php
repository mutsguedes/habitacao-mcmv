<?php

namespace app\modules\cli\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use app\components\MarArtHelpers;
use app\modules\auxiliar\models\GerProjeto;
use app\modules\cli\models\McmvwsQuery;
use app\modules\auxiliar\models\GerCorSituacao;
use app\modules\auxiliar\models\GerProjetoQuery;
use app\modules\auxiliar\models\GerCorSituacaoQuery;

/**
 * This is the model class for table "mcmvws".
 *
 * @property int $id_num_res Id da tabela responsaveis:
 * @property string $dt_atu_bas Atualização:
 * @property string $nm_ide_pes Tipo pessoa:
 * @property string $nu_num_seq Sequencial:
 * @property string $nu_num_ins Inscrição:
 * @property int $bo_reg_exc Excluído:
 * @property int $bo_tec_soc Pesquisa:
 * @property int $id_num_proj GerProjeto:
 * @property int $id_cor_sit Situação:
 * @property string $id_con_ocu Apartamento:
 * @property string|null $dt_sor_res Sorteado:
 * @property string $nm_nom_res Nome:
 * @property string|null $dt_nas_res D.N.:
 * @property string $nu_num_cpf CPF:
 * @property string|null $nm_nom_obs Obs:
 *
 * @property GerProjeto $numProj
 * @property GerCorSituacao $corSit
 */
class Mcmvws extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'responsavel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dt_atu_bas', 'nm_nom_res'], 'required'],
            [['dt_atu_bas', 'dt_sor_res', 'dt_nas_res'], 'safe'],
            [['bo_reg_exc', 'bo_tec_soc', 'id_num_proj', 'id_cor_sit'], 'integer'],
            [['nm_ide_pes'], 'string', 'max' => 1],
            [['nu_num_seq'], 'string', 'max' => 5],
            [['nu_num_ins', 'nu_num_cpf'], 'string', 'max' => 15],
            [['id_con_ocu'], 'string', 'max' => 9],
            [['nm_nom_res'], 'string', 'max' => 60],
            [['nm_nom_obs'], 'string', 'max' => 255],
            [['id_num_proj'], 'exist', 'skipOnError' => true, 'targetClass' => GerProjeto::class, 'targetAttribute' => ['id_num_proj' => 'id_num_proj']],
            [['id_cor_sit'], 'exist', 'skipOnError' => true, 'targetClass' => GerCorSituacao::class, 'targetAttribute' => ['id_cor_sit' => 'id_cor_sit']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_num_res' => 'Id da tabela responsaveis:',
            'dt_atu_bas' => 'Atualização:',
            'nm_ide_pes' => 'Tipo pessoa:',
            'nu_num_seq' => 'Sequencial:',
            'nu_num_ins' => 'Inscrição:',
            'bo_reg_exc' => 'Excluído:',
            'bo_tec_soc' => 'Pesquisa:',
            'id_num_proj' => 'GerProjeto:',
            'id_cor_sit' => 'Situação:',
            'id_con_ocu' => 'Apartamento:',
            'dt_sor_res' => 'Sorteado:',
            'nm_nom_res' => 'Nome:',
            'dt_nas_res' => 'D.N.:',
            'nu_num_cpf' => 'CPF:',
            'nm_nom_obs' => 'Obs:',
        ];
    }

    /**
     * Gets query for [[NumProj]].
     *
     * @return ActiveQuery|GerProjetoQuery
     */
    public function getNumProj()
    {
        return $this->hasOne(GerProjeto::class, ['id_num_proj' => 'id_num_proj']);
    }

    /**
     * Gets query for [[CorSit]].
     *
     * @return ActiveQuery|GerCorSituacaoQuery
     */
    public function getCorSit()
    {
        return $this->hasOne(GerCorSituacao::class, ['id_cor_sit' => 'id_cor_sit']);
    }

    /**
     * {@inheritdoc}
     * @return McmvwsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new McmvwsQuery(get_called_class());
    }

    public function fields()
    {
        $fields = parent::fields();
        $fields['GerProjeto'] = $this->numProj->nm_nom_proj;
        $fields['Inscricao'] = MarArtHelpers::mascaraString('####.##.##', $this->nu_num_ins) . '/' . $this->nu_num_seq;
        $fields['Atualização'] = date('d/m/Y', strtotime("last friday"));
        $fields['Nome'] = ltrim($this->nm_nom_res);
        $fields['CPF'] = MarArtHelpers::mascaraString('###.###.###-##', $this->nu_num_cpf);
        $fields['D.N.'] = $this->dt_nas_res ? date("d/m/Y", strtotime($this->dt_nas_res)) : 'Não informado.';
        $fields['Situação'] = $this->corSit->nm_des_sit;
        $fields['Descrição'] = $this->corSit->nm_sit_des;
        $fields['Cor'] = $this->corSit->nm_cor_sit;
        $fields['Data contemplação'] = $this->dt_sor_res ? $this->dt_sor_res : 'Não Sorteado.';

        // remove campos que contém informações confidenciais
        unset(
            $fields['nm_ide_pes'],
            $fields['nu_num_seq'],
            $fields['dt_nas_res'],
            $fields['nm_nom_res'],
            $fields['dt_sor_res'],
            $fields['nm_nom_obs'],
            $fields['nu_num_ins'],
            $fields['id_cor_sit'],
            $fields['bo_reg_exc'],
            $fields['bo_tec_soc'],
            $fields['nu_num_cpf'],
            $fields['id_con_ocu'],
            $fields['id_num_res'],
            $fields['id_num_proj']
        );


        return $fields;
    }
}
