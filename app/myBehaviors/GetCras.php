<?php

namespace app\myBehaviors;

use app\modules\auxiliar\models\GerCras;
use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;

/**
 * Description of GetCras
 *
 * @author marcos
 */
class GetCras extends Behavior
{

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'busCras',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'busCras'
        ];
    }

    public function busCras(Event $event)
    {
        $resultC = GerCras::find()
            ->select('id_num_cra')
            ->orWhere(['=', 'nm_nom_bai', mb_convert_case($this->owner->nm_nom_bai, MB_CASE_UPPER, "UTF-8")])
            ->orWhere(['=', 'nm_nom_loc', mb_convert_case($this->owner->nm_nom_bai, MB_CASE_UPPER, "UTF-8")])
            ->all();
        if (empty($resultC)) {
            $this->owner->id_num_cra = 1;
        } else {
            $this->owner->id_num_cra = $resultC[0]->id_num_cra;
        }
    }
}
