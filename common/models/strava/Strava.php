<?php

namespace common\models\strava;

use common\models\User;
use Yii;

/**
 * This is the model class for table "stravaitems".
 *
 * @property int $id
 * @property int $strava_id
 * @property string $access_token
 * @property bool $register
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property bool $deleted
 *
 * @property Users $user
 */
class Strava extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stravaitems';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['strava_id', 'user_id'], 'default', 'value' => null],
            [['strava_id', 'user_id'], 'integer'],
            [['register', 'deleted'], 'boolean'],
            [['created_at', 'updated_at'], 'safe'],
            [['access_token'], 'string', 'max' => 255],
            [['access_token'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('strava', 'ID'),
            'strava_id' => Yii::t('strava', 'Strava ID'),
            'access_token' => Yii::t('strava', 'Access Token'),
            'register' => Yii::t('strava', 'Register'),
            'user_id' => Yii::t('strava', 'User ID'),
            'created_at' => Yii::t('strava', 'Created At'),
            'updated_at' => Yii::t('strava', 'Updated At'),
            'deleted' => Yii::t('strava', 'Deleted'),
        ];
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
     * @return StravaitemsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StravaitemsQuery(get_called_class());
    }
}
