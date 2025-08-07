<?php

namespace app\modules\auxiliar\models;

/**
 * This is the ActiveQuery class for [[GerEtnia]].
 *
 * @see GerEtnia
 */
class GerEtniaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GerEtnia[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GerEtnia|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
