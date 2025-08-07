<?php

namespace app\modules\auxiliar\models;

/**
 * This is the ActiveQuery class for [[GerNatOcupacao]].
 *
 * @see GerNatOcupacao
 */
class GerNatOcupacaoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GerNatOcupacao[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GerNatOcupacao|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
