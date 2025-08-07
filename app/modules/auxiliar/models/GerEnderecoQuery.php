<?php

namespace app\modules\auxiliar\models;

/**
 * This is the ActiveQuery class for [[GerEndereco]].
 *
 * @see GerEndereco
 */
class GerEnderecoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GerEndereco[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GerEndereco|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
