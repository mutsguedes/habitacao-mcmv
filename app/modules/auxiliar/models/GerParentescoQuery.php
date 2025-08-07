<?php

namespace app\modules\auxiliar\models;

/**
 * This is the ActiveQuery class for [[GerParentesco]].
 *
 * @see GerParentesco
 */
class GerParentescoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GerParentesco[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GerParentesco|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
