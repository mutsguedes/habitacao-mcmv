<?php

namespace app\modules\auxiliar\models;

/**
 * This is the ActiveQuery class for [[GerTecsocAgriZoonoze]].
 *
 * @see GerTecsocAgriZoonoze
 */
class GerTecsocAgriZoonozeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GerTecsocAgriZoonoze[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GerTecsocAgriZoonoze|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
