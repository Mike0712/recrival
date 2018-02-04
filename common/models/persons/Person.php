<?php

namespace common\models\persons;

use common\models\clubs\Club;
use common\models\User;
use Yii;

/**
 * This is the model class for table "persons".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property string $birthday
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property bool $deleted
 *
 * @property PersonClub[] $personClubs
 * @property Users $user
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'persons';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gender'], 'string'],
            [['birthday', 'created_at', 'updated_at'], 'safe'],
            [['user_id'], 'default', 'value' => null],
            [['user_id'], 'integer'],
            [['deleted'], 'boolean'],
            [['first_name', 'last_name'], 'string', 'max' => 255],
            [['user_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('persons', 'ID'),
            'first_name' => Yii::t('persons', 'First Name'),
            'last_name' => Yii::t('persons', 'Last Name'),
            'gender' => Yii::t('persons', 'Gender'),
            'birthday' => Yii::t('persons', 'Birthday'),
            'user_id' => Yii::t('persons', 'User ID'),
            'created_at' => Yii::t('persons', 'Created At'),
            'updated_at' => Yii::t('persons', 'Updated At'),
            'deleted' => Yii::t('persons', 'Deleted'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClubs()
    {
        return $this->hasMany(Club::className(), ['id' => 'club_id'])
            ->viaTable('person_club', ['person_id' => 'id']);
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
     * @return PersonsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PersonsQuery(get_called_class());
    }
}
