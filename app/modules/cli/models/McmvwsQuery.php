<?php

namespace app\modules\cli\models;

use yii\db\ActiveQuery;
use app\modules\cli\models\Mcmvws;

/**
 * This is the ActiveQuery class for [[Mcmvws]].
 *
 * @see Mcmvws
 */
class McmvwsQuery extends ActiveQuery
{
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return Mcmvws[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Mcmvws|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
