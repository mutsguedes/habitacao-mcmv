<?php

namespace app\modules\auxiliar\models;

/**
 * This is the ActiveQuery class for [[GerTabUniCid]].
 *
 * @see GerTabUniCid
 */
class GerTabUniCidQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GerTabUniCid[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GerTabUniCid|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
