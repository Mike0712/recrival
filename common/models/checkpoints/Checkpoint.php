<?php

namespace common\models\checkpoints;

use common\models\results\Result;
use common\models\tracks\Track;
use Yii;

/**
 * This is the model class for table "checkpoints".
 *
 * @property int $id
 * @property string $name
 * @property double $value
 * @property double $lattitude
 * @property double $longditude
 * @property int $track_id
 * @property string $created_at
 * @property string $updated_at
 * @property bool $deleted
 *
 * @property Tracks $track
 * @property Results[] $results
 */
class Checkpoint extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'checkpoints';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value', 'lattitude', 'longditude'], 'number'],
            [['track_id'], 'default', 'value' => null],
            [['track_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['deleted'], 'boolean'],
            [['name'], 'string', 'max' => 255],
            [['track_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tracks::className(), 'targetAttribute' => ['track_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('checkpoints', 'ID'),
            'name' => Yii::t('checkpoints', 'Name'),
            'value' => Yii::t('checkpoints', 'Value'),
            'lattitude' => Yii::t('checkpoints', 'Lattitude'),
            'longditude' => Yii::t('checkpoints', 'Longditude'),
            'track_id' => Yii::t('checkpoints', 'Track ID'),
            'created_at' => Yii::t('checkpoints', 'Created At'),
            'updated_at' => Yii::t('checkpoints', 'Updated At'),
            'deleted' => Yii::t('checkpoints', 'Deleted'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrack()
    {
        return $this->hasOne(Track::className(), ['id' => 'track_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResults()
    {
        return $this->hasMany(Result::className(), ['checkpoint_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CheckpointsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CheckpointsQuery(get_called_class());
    }
}
