<?php

namespace app\myBehaviors;

use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;

/**
 * Description of GeraNumero
 *
 * @author marcos
 */
class GeraNumero extends Behavior {

    public function events() {
        return[
            ActiveRecord::EVENT_BEFORE_INSERT => 'gerComNum'
        ];
    }

    public function gerComNum(Event $event) {
        $this->owner->nu_num_num = date('dmY');
        $this->owner->nu_num_seq = str_pad((intval($this->owner::find()->max('nu_num_seq')) + 1), 5, '0', STR_PAD_LEFT);
    }

}
