<?php

namespace app\modules\auxiliar\models;

/**
 * This is the ActiveQuery class for [[GerServico]].
 *
 * @see GerServico
 */
class GerServicoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GerServico[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GerServico|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
