<?php

namespace app\modules\api\models;

/**
 * This is the ActiveQuery class for [[GerAssunto]].
 *
 * @see GerAssunto
 */
class GerAssuntoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GerAssunto[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GerAssunto|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
