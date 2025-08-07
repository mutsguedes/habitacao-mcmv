<?php

namespace app\modules\tecsoc\models;

/**
 * This is the ActiveQuery class for [[TecsocDocumento]].
 *
 * @see TecsocDocumento
 */
class TecsocDocumentoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TecsocDocumento[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TecsocDocumento|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
