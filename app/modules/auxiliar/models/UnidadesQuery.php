<?php

namespace app\modules\auxiliar\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Unidades1]].
 *
 * @see Unidades1
 */
class UnidadesQuery extends ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * @inheritdoc
     * @return Unidades1[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Unidades1|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

}
