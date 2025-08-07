<?php

namespace app\modules\auxiliar\models;

/**
 * This is the ActiveQuery class for [[AgendaFeriado]].
 *
 * @see AgendaFeriado
 */
class AgendaFeriadoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AgendaFeriado[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AgendaFeriado|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
