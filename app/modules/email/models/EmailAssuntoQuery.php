<?php

namespace app\modules\email\models;

/**
 * This is the ActiveQuery class for [[EmailAssunto]].
 *
 * @see EmailAssunto
 */
class EmailAssuntoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return EmailAssunto[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return EmailAssunto|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
