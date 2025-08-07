<?php

namespace app\modules\tecsoc\models;

use app\modules\tecsoc\models\TecnicoSocial;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[TecnicoSocial]].
 *
 * @see TecnicoSocial
 */
class TecnicoSocialQuery extends ActiveQuery
{
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return TecnicoSocial[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TecnicoSocial|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
