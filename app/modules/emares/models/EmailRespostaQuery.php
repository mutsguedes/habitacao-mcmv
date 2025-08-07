<?php

namespace app\modules\emares\models;

/**
 * This is the ActiveQuery class for [[EmailResposta]].
 *
 * @see EmailResposta
 */
class EmailRespostaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return EmailResposta[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return EmailResposta|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
