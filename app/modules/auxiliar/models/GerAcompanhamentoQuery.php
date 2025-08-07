<?php

namespace app\modules\auxiliar\models;

/**
 * This is the ActiveQuery class for [[GerAcompanhamento]].
 *
 * @see GerAcompanhamento
 */
class GerAcompanhamentoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GerAcompanhamento[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GerAcompanhamento|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
