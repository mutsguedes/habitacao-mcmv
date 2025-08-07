<?php

namespace app\modules\auxiliar\models;

/**
 * This is the ActiveQuery class for [[GerMunicipio]].
 *
 * @see GerMunicipio
 */
class GerMunicipioQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GerMunicipio[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GerMunicipio|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
