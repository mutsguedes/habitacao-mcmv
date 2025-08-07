<?php

namespace app\modules\api\models;

/**
 * This is the ActiveQuery class for [[GerState]].
 *
 * @see GerState
 */
class GerStateQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GerState[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GerState|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
