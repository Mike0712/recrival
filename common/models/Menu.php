<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property string $url
 * @property int $parent_id
 * @property int $type
 * @property int $application
 * @property string $created_at
 * @property string $updated_at
 *
 * @property MenuTranslation[] $menuTranslations
 */
class Menu extends \yii\db\ActiveRecord
{
    const APPLICATION_FRONTEND = 1;
    const APPLICATION_BACKEND = 2;

    const TYPE_MENU_MAIN = 1;

    const BLOCK_TYPE_SIMPLE = 1;
    const BLOCK_TYPE_SLIDER = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'type', 'application'], 'default', 'value' => null],
            [['parent_id', 'type', 'application'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'url' => Yii::t('app', 'Url'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'type' => Yii::t('app', 'Type'),
            'application' => Yii::t('app', 'Application'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuTranslations()
    {
        return $this->hasMany(MenuTranslation::className(), ['menu_id' => 'id']);
    }

    public function getParent()
    {
        return $this->hasOne(Menu::className(), ['id' => 'parent_id']);
    }

    public function getChildren()
    {
        return $this->hasMany(self::className(), ['parent_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return MenuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MenuQuery(get_called_class());
    }
}
