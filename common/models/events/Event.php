<?php

namespace common\models\events;

use common\models\races\Race;
use common\models\tracks\Track;
use common\models\User;
use Yii;

/**
 * This is the model class for table "events".
 *
 * @property int $id
 * @property string $date_start
 * @property string $date_finish
 * @property int $org_id
 * @property string $created_at
 * @property string $updated_at
 * @property bool $deleted
 *
 * @property EventTrack[] $eventTracks
 * @property Users $org
 * @property EventsTranslation[] $eventsTranslations
 * @property Races[] $races
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'events';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_start', 'date_finish', 'created_at', 'updated_at'], 'safe'],
            [['org_id'], 'default', 'value' => null],
            [['org_id'], 'integer'],
            [['deleted'], 'boolean'],
            [['org_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['org_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('events', 'ID'),
            'date_start' => Yii::t('events', 'Date Start'),
            'date_finish' => Yii::t('events', 'Date Finish'),
            'org_id' => Yii::t('events', 'Org ID'),
            'created_at' => Yii::t('events', 'Created At'),
            'updated_at' => Yii::t('events', 'Updated At'),
            'deleted' => Yii::t('events', 'Deleted'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTracks()
    {
        return $this->hasMany(Track::className(), ['id' => 'event_id'])
            ->viaTable('event_track', ['track_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrg()
    {
        return $this->hasOne(User::className(), ['id' => 'org_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventsTranslations()
    {
        return $this->hasMany(TranslationModel::className(), ['event_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaces()
    {
        return $this->hasMany(Race::className(), ['event_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return EventsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EventsQuery(get_called_class());
    }
}
