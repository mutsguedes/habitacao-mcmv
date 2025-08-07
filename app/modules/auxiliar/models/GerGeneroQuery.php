<?php

namespace app\modules\auxiliar\models;

/**
 * This is the ActiveQuery class for [[GerGenero]].
 *
 * @see GerGenero
 */
class GerGeneroQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GerGenero[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GerGenero|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
