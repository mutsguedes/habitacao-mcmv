<?php

namespace app\myBehaviors;

use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;

/**
 * Description of GenInscricao
 *
 * @author marcos
 */
class GeraInscricao extends Behavior {

    public function events() {
        return[
            ActiveRecord::EVENT_BEFORE_INSERT => 'gerComIns'
        ];
    }

    public function gerComIns(Event $event) {
        $this->owner->nu_num_ins = date('Ymd');
        $this->owner->nu_num_seq = str_pad((intval($this->owner::find()->max('nu_num_seq')) + 1), 5, '0', STR_PAD_LEFT);
    }

}
