<?php

namespace app\modules\auxiliar\models;

/**
 * This is the ActiveQuery class for [[GerTecsocHabSerEnergiaEletrica]].
 *
 * @see GerTecsocHabSerEnergiaEletrica
 */
class GerTecsocHabSerEnergiaEletricaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GerTecsocHabSerEnergiaEletrica[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GerTecsocHabSerEnergiaEletrica|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
