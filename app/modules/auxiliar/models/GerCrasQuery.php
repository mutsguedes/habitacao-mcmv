<?php

namespace app\modules\auxiliar\models;

/**
 * This is the ActiveQuery class for [[GerCras]].
 *
 * @see GerCras
 */
class GerCrasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GerCras[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GerCras|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
