<?php

namespace app\modules\agepes\models;

use app\modules\user\models\User;
use app\modules\user\models\UserQuery;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "events".
 *
 * @property int $id ID
 * @property int $id_user User
 * @property string $title Title
 * @property string|null $text Text
 * @property string $start Start Date
 * @property string $end End Date
 * @property string $all_day All day
 * @property string $color_background Background color
 * @property string $color_text Text color
 * @property string $status Status
 *
 * @property User $user
 */
class Events extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'events';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'title', 'start', 'end', 'color_background', 'color_text'], 'required'],
            [['id_user'], 'integer'],
            [['text', 'all_day', 'status'], 'string'],
            [['start', 'end'], 'safe'],
            [['title'], 'string', 'max' => 180],
            [['color_background', 'color_text'], 'string', 'max' => 7],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'User',
            'title' => 'Title',
            'text' => 'Text',
            'start' => 'Start Date',
            'end' => 'End Date',
            'all_day' => 'All day',
            'color_background' => 'Background color',
            'color_text' => 'Text color',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * {@inheritdoc}
     * @return EventsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EventsQuery(get_called_class());
    }
}
