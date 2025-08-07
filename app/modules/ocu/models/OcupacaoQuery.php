<?php

namespace app\modules\ocu\models;

/**
 * This is the ActiveQuery class for [[Ocupacao]].
 *
 * @see Ocupacao
 */
class OcupacaoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Ocupacao[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Ocupacao|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
