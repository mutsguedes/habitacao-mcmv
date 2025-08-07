<?php

namespace app\modules\auxiliar\models;

/**
 * This is the ActiveQuery class for [[GerTecsocEquipamentoPub]].
 *
 * @see GerTecsocEquipamentoPub
 */
class GerTecsocEquipamentoPubQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GerTecsocEquipamentoPub[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GerTecsocEquipamentoPub|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
