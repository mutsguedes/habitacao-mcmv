<?php

namespace app\modules\auxiliar\models;

/**
 * This is the ActiveQuery class for [[GerProjeto]].
 *
 * @see GerProjeto
 */
class GerProjetoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GerProjeto[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GerProjeto|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
