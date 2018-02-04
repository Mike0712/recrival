<?php

namespace common\models\clubs;

use common\models\persons\Person;
use Yii;

/**
 * This is the model class for table "clubs".
 *
 * @property int $id
 * @property string $logo
 * @property string $alias
 * @property int $place_id
 * @property string $created_at
 * @property string $updated_at
 * @property bool $deleted
 *
 * @property ClubsTranslation[] $clubsTranslations
 * @property PersonClub[] $personClubs
 */
class Club extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clubs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['place_id'], 'default', 'value' => null],
            [['place_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['deleted'], 'boolean'],
            [['logo', 'alias'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('clubs', 'ID'),
            'logo' => Yii::t('clubs', 'Logo'),
            'alias' => Yii::t('clubs', 'Alias'),
            'place_id' => Yii::t('clubs', 'Place ID'),
            'created_at' => Yii::t('clubs', 'Created At'),
            'updated_at' => Yii::t('clubs', 'Updated At'),
            'deleted' => Yii::t('clubs', 'Deleted'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClubsTranslations()
    {
        return $this->hasMany(TranslationModel::className(), ['club_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersons()
    {
        return $this->hasMany(Person::className(), ['id' => 'person_id'])
            ->viaTable('person_club', ['club_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ClubsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClubsQuery(get_called_class());
    }
}
