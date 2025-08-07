<?php

namespace app\modules\auxiliar\models;

/**
 * This is the ActiveQuery class for [[GerTecsocAtividade]].
 *
 * @see GerTecsocAtividade
 */
class GerTecsocAtividadeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GerTecsocAtividade[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GerTecsocAtividade|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
