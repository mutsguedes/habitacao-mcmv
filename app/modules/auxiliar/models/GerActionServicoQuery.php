<?php

namespace app\modules\auxiliar\models;

/**
 * This is the ActiveQuery class for [[GerActionServico]].
 *
 * @see GerActionServico
 */
class GerActionServicoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GerActionServico[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GerActionServico|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
