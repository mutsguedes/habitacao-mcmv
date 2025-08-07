<?php

namespace app\modules\auxiliar\models;

/**
 * This is the ActiveQuery class for [[GerTecsocAtividadeFis]].
 *
 * @see GerTecsocAtividadeFis
 */
class GerTecsocAtividadeFisQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GerTecsocAtividadeFis[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GerTecsocAtividadeFis|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
