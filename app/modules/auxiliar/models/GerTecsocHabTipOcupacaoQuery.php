<?php

namespace app\modules\auxiliar\models;

/**
 * This is the ActiveQuery class for [[GerTecsocHabTipOcupacao]].
 *
 * @see GerTecsocHabTipOcupacao
 */
class GerTecsocHabTipOcupacaoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GerTecsocHabTipOcupacao[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GerTecsocHabTipOcupacao|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
