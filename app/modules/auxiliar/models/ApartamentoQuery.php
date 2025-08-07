<?php

namespace app\modules\auxiliar\models;

/**
 * This is the ActiveQuery class for [[Apartamento]].
 *
 * @see Apartamento
 */
class ApartamentoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Apartamento[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Apartamento|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
