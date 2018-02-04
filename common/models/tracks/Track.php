<?php

namespace common\models\tracks;

use common\models\checkpoints\Checkpoint;
use common\models\races\Race;
use common\models\User;
use Symfony\Component\EventDispatcher\Event;
use Yii;

/**
 * This is the model class for table "tracks".
 *
 * @property int $id
 * @property string $title
 * @property double $distance
 * @property string $polyline
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property bool $deleted
 *
 * @property Checkpoints[] $checkpoints
 * @property EventTrack[] $eventTracks
 * @property Races[] $races
 * @property Users $user
 */
class Track extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tracks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['distance'], 'number'],
            [['polyline'], 'string'],
            [['user_id'], 'default', 'value' => null],
            [['user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['deleted'], 'boolean'],
            [['title'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('tracks', 'ID'),
            'title' => Yii::t('tracks', 'Title'),
            'distance' => Yii::t('tracks', 'Distance'),
            'polyline' => Yii::t('tracks', 'Polyline'),
            'user_id' => Yii::t('tracks', 'User ID'),
            'created_at' => Yii::t('tracks', 'Created At'),
            'updated_at' => Yii::t('tracks', 'Updated At'),
            'deleted' => Yii::t('tracks', 'Deleted'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCheckpoints()
    {
        return $this->hasMany(Checkpoint::className(), ['track_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['id' => 'track_id'])
            ->viaTable('event_track', ['event_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaces()
    {
        return $this->hasMany(Race::className(), ['track_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return TracksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TracksQuery(get_called_class());
    }
}
