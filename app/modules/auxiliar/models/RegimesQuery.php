<?php

namespace app\modules\auxiliar\models;

use app\modules\auxiliar\models\Regimes;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Regimes]].
 *
 * @see Regimes
 */
class RegimesQuery extends ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * @inheritdoc
     * @return Regimes[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Regimes|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

}
