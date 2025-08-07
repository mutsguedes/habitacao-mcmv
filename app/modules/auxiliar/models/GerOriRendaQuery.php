<?php

namespace app\modules\auxiliar\models;

/**
 * This is the ActiveQuery class for [[GerOriRenda]].
 *
 * @see GerOriRenda
 */
class GerOriRendaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GerOriRenda[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GerOriRenda|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
