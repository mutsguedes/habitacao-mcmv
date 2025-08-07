<?php

namespace app\modules\emares\models;

/**
 * This is the ActiveQuery class for [[EmailAndamento]].
 *
 * @see EmailAndamento
 */
class EmailAndamentoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return EmailAndamento[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return EmailAndamento|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
