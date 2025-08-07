<?php

namespace app\modules\api\models;

/**
 * This is the ActiveQuery class for [[AgendaHorario]].
 *
 * @see AgendaHorario
 */
class AgendaHorarioQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AgendaHorario[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AgendaHorario|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
