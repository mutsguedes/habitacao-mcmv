<?php

namespace app\modules\auxiliar\models;

/**
 * This is the ActiveQuery class for [[GerEstadoCivil]].
 *
 * @see GerEstadoCivil
 */
class GerEstadoCivilQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GerEstadoCivil[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GerEstadoCivil|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
