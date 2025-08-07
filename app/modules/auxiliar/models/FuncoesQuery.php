<?php

namespace app\modules\auxiliar\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Funcoes]].
 *
 * @see Funcoes
 */
class FuncoesQuery extends ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * @inheritdoc
     * @return Funcoes[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Funcoes|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

}
