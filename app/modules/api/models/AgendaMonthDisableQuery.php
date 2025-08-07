<?php

namespace app\modules\api\models;

/**
 * This is the ActiveQuery class for [[AgendaMonthDisable]].
 *
 * @see AgendaMonthDisable
 */
class AgendaMonthDisableQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AgendaMonthDisable[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AgendaMonthDisable|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
