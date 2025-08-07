<?php

namespace app\modules\tecsoc\models;

/**
 * This is the ActiveQuery class for [[TecsocFamilia]].
 *
 * @see TecsocFamilia
 */
class TecsocFamiliaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TecsocFamilia[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TecsocFamilia|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
