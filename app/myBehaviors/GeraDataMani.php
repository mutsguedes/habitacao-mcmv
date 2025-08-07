<?php

namespace app\myBehaviors;

use Yii;
use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;

/**
 * Description of GeraDataMani
 *
 * @author marcos
 */
class GeraDataMani extends Behavior {

    public function events() {
        return[
            ActiveRecord::EVENT_BEFORE_INSERT => 'gerComData',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'gerComData'
        ];
    }

    public function gerComData(Event $event) {
        if (Yii::$app->user->can('administrativo')) {
            $this->owner->dt_ema_man = date('Y-m-d', strtotime('+5 days'));
        } else if (Yii::$app->user->can('visitante')) {
            $this->owner->dt_ema_man = date('Y-m-d', strtotime('+3 days'));
        }
    }

}
