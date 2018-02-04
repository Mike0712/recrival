<?php

namespace common\models\clubs;

use Yii;

/**
 * This is the model class for table "clubs_translation".
 *
 * @property int $id
 * @property int $club_id
 * @property string $language_code
 * @property string $club_code
 * @property string $club_name
 *
 * @property Clubs $club
 */
class TranslationModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clubs_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['club_id'], 'default', 'value' => null],
            [['club_id'], 'integer'],
            [['language_code', 'club_code'], 'string', 'max' => 10],
            [['club_name'], 'string', 'max' => 255],
            [['club_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clubs::className(), 'targetAttribute' => ['club_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('clubs', 'ID'),
            'club_id' => Yii::t('clubs', 'Club ID'),
            'language_code' => Yii::t('clubs', 'Language Code'),
            'club_code' => Yii::t('clubs', 'Club Code'),
            'club_name' => Yii::t('clubs', 'Club Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClub()
    {
        return $this->hasOne(Club::className(), ['id' => 'club_id']);
    }

    /**
     * @inheritdoc
     * @return ClubsTranslationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClubsTranslationQuery(get_called_class());
    }
}
