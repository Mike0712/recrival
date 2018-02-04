<?php

namespace common\models\events;

use Yii;

/**
 * This is the model class for table "events_translation".
 *
 * @property int $id
 * @property int $event_id
 * @property string $language_code
 * @property string $event_name
 *
 * @property Events $event
 */
class TranslationModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'events_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_id'], 'default', 'value' => null],
            [['event_id'], 'integer'],
            [['event_name'], 'string'],
            [['language_code'], 'string', 'max' => 10],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Events::className(), 'targetAttribute' => ['event_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('events', 'ID'),
            'event_id' => Yii::t('events', 'Event ID'),
            'language_code' => Yii::t('events', 'Language Code'),
            'event_name' => Yii::t('events', 'Event Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }

    /**
     * @inheritdoc
     * @return EventsTranslationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EventsTranslationQuery(get_called_class());
    }
}
