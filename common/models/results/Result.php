<?php

namespace common\models\results;

use common\models\checkpoints\Checkpoint;
use common\models\User;
use Yii;

/**
 * This is the model class for table "results".
 *
 * @property int $id
 * @property string $total_time
 * @property int $user_id
 * @property int $checkpoint_id
 *
 * @property Checkpoints $checkpoint
 * @property Users $user
 */
class Result extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'results';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['total_time'], 'safe'],
            [['user_id', 'checkpoint_id'], 'default', 'value' => null],
            [['user_id', 'checkpoint_id'], 'integer'],
            [['checkpoint_id'], 'exist', 'skipOnError' => true, 'targetClass' => Checkpoints::className(), 'targetAttribute' => ['checkpoint_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('results', 'ID'),
            'total_time' => Yii::t('results', 'Total Time'),
            'user_id' => Yii::t('results', 'User ID'),
            'checkpoint_id' => Yii::t('results', 'Checkpoint ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCheckpoint()
    {
        return $this->hasOne(Checkpoint::className(), ['id' => 'checkpoint_id']);
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
     * @return ResultsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ResultsQuery(get_called_class());
    }
}
