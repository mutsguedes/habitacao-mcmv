<?php

namespace app\modules\auxiliar\models;

/**
 * This is the ActiveQuery class for [[GerGrauInstrucao]].
 *
 * @see GerGrauInstrucao
 */
class GerGrauInstrucaoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GerGrauInstrucao[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GerGrauInstrucao|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
