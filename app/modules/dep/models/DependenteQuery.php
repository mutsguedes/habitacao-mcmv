<?php

namespace app\modules\dep\models;

/**
 * This is the ActiveQuery class for [[Dependente]].
 *
 * @see Dependente
 */
class DependenteQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Dependente[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Dependente|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
