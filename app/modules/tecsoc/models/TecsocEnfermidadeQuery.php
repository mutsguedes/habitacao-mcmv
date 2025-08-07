<?php

namespace app\modules\tecsoc\models;

/**
 * This is the ActiveQuery class for [[TecsocEnfermidade]].
 *
 * @see TecsocEnfermidade
 */
class TecsocEnfermidadeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TecsocEnfermidade[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TecsocEnfermidade|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
