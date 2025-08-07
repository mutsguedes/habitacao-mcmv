<?php

namespace app\modules\auxiliar\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Turnos]].
 *
 * @see Turnos
 */
class TurnosQuery extends ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * @inheritdoc
     * @return Turnos[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Turnos|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

}
