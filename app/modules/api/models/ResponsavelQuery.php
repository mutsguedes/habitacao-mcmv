<?php

namespace app\modules\api\models;

/**
 * This is the ActiveQuery class for [[Responsavel]].
 *
 * @see Responsavel
 */
class ResponsavelQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Responsavel[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Responsavel|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
