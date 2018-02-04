<?php

namespace common\models\races;

use Yii;

/**
 * This is the model class for table "races".
 *
 * @property int $id
 * @property string $title
 * @property int $event_id
 * @property int $track_id
 * @property string $created_at
 * @property string $updated_at
 * @property bool $deleted
 *
 * @property RaceTimes[] $raceTimes
 * @property Events $event
 * @property Tracks $track
 */
class Race extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'races';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_id', 'track_id'], 'default', 'value' => null],
            [['event_id', 'track_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['deleted'], 'boolean'],
            [['title'], 'string', 'max' => 255],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Events::className(), 'targetAttribute' => ['event_id' => 'id']],
            [['track_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tracks::className(), 'targetAttribute' => ['track_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('races', 'ID'),
            'title' => Yii::t('races', 'Title'),
            'event_id' => Yii::t('races', 'Event ID'),
            'track_id' => Yii::t('races', 'Track ID'),
            'created_at' => Yii::t('races', 'Created At'),
            'updated_at' => Yii::t('races', 'Updated At'),
            'deleted' => Yii::t('races', 'Deleted'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaceTimes()
    {
        return $this->hasMany(RaceTimes::className(), ['race_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Events::className(), ['id' => 'event_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrack()
    {
        return $this->hasOne(Tracks::className(), ['id' => 'track_id']);
    }

    /**
     * @inheritdoc
     * @return RacesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RacesQuery(get_called_class());
    }
}
