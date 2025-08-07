<?php

namespace app\modules\auxiliar\models;

/**
 * This is the ActiveQuery class for [[PageUser]].
 *
 * @see PageUser
 */
class PageUserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PageUser[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PageUser|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
