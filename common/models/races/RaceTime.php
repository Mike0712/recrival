<?php

namespace common\models\races;

use Yii;

/**
 * This is the model class for table "race_times".
 *
 * @property int $id
 * @property string $time_start
 * @property int $race_id
 *
 * @property Races $race
 */
class RaceTime extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'race_times';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['time_start'], 'safe'],
            [['race_id'], 'default', 'value' => null],
            [['race_id'], 'integer'],
            [['race_id'], 'exist', 'skipOnError' => true, 'targetClass' => Races::className(), 'targetAttribute' => ['race_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('races', 'ID'),
            'time_start' => Yii::t('races', 'Time Start'),
            'race_id' => Yii::t('races', 'Race ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRace()
    {
        return $this->hasOne(Races::className(), ['id' => 'race_id']);
    }

    /**
     * @inheritdoc
     * @return RaceTimesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RaceTimesQuery(get_called_class());
    }
}
