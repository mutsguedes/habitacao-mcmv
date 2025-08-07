<?php

namespace app\modules\auxiliar\models;

/**
 * This is the ActiveQuery class for [[GerTecsocBeneficioSoc]].
 *
 * @see GerTecsocBeneficioSoc
 */
class GerTecsocBeneficioSocQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GerTecsocBeneficioSoc[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GerTecsocBeneficioSoc|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
