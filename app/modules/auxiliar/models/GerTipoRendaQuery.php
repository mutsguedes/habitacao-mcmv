<?php

namespace app\modules\auxiliar\models;

/**
 * This is the ActiveQuery class for [[GerTipoRenda]].
 *
 * @see GerTipoRenda
 */
class GerTipoRendaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GerTipoRenda[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GerTipoRenda|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
