<?php

namespace app\modules\end\models;

/**
 * This is the ActiveQuery class for [[Endereco]].
 *
 * @see Endereco
 */
class EnderecoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Endereco[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Endereco|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
