<?php

namespace app\modules\auxiliar\models;

/**
 * This is the ActiveQuery class for [[GerTesocBeneficioSoc]].
 *
 * @see GerTesocBeneficioSoc
 */
class GerTesocBeneficioSocQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GerTesocBeneficioSoc[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GerTesocBeneficioSoc|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
