<?php

namespace app\myBehaviors;

use Yii;
use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;

/**
 * Description of UpperCase
 *
 * @author marcos
 */
class UpperCase extends Behavior {

    public function events() {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'upperCaseAtribute',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'upperCaseAtribute',
        ];
    }

    public function upperCaseAtribute(Event $event) {
        if (Yii::$app->controller->id == 'responsaveis') {
            $this->owner->nm_nom_res = strtoupper(ltrim($this->owner->nm_nom_res));
            $this->owner->nm_nom_log = strtoupper(ltrim($this->owner->nm_nom_log));
            $this->owner->nm_nom_mun = strtoupper(ltrim($this->owner->nm_nom_mun));
            $this->owner->nm_nom_com = strtoupper(ltrim($this->owner->nm_nom_com));
            $this->owner->nm_nom_bai = strtoupper(ltrim($this->owner->nm_nom_bai));
            $this->owner->nm_nom_est = strtoupper(ltrim($this->owner->nm_nom_est));
            $this->owner->nm_nom_obs = strtoupper(ltrim($this->owner->nm_nom_obs));
            $this->owner->nu_cod_cid = strtoupper(ltrim($this->owner->nu_cod_cid));
            $this->owner->nm_des_cid = strtoupper(ltrim($this->owner->nm_des_cid));
        };
        if (Yii::$app->controller->id == 'dependentes') {
            $this->owner->nm_nom_dep = strtoupper(ltrim($this->owner->nm_nom_dep));
            $this->owner->nm_nom_obs = strtoupper(ltrim($this->owner->nm_nom_obs));
            $this->owner->nm_des_cid = strtolower(ltrim($this->owner->nm_des_cid));
        };
        if (Yii::$app->controller->id == 'agendas') {
            $this->owner->nm_nom_cid = strtoupper(ltrim($this->owner->nm_nom_cid));
        };
    }

}
