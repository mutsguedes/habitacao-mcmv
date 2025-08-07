<?php

namespace app\modules\auxiliar\models;

/**
 * This is the ActiveQuery class for [[GerTabUniCbo]].
 *
 * @see GerTabUniCbo
 */
class GerTabUniCboQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GerTabUniCbo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GerTabUniCbo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
