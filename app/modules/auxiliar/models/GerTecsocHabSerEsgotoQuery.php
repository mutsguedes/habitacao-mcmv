<?php

namespace app\modules\auxiliar\models;

/**
 * This is the ActiveQuery class for [[GerTecsocHabSerEsgoto]].
 *
 * @see GerTecsocHabSerEsgoto
 */
class GerTecsocHabSerEsgotoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GerTecsocHabSerEsgoto[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GerTecsocHabSerEsgoto|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
