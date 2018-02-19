<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "menu_translation".
 *
 * @property int $id
 * @property string $title
 * @property string $language_code
 * @property int $menu_id
 *
 * @property Menu $menu
 */
class MenuTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_id'], 'default', 'value' => null],
            [['menu_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['language_code'], 'string', 'max' => 10],
            [['menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::className(), 'targetAttribute' => ['menu_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'language_code' => Yii::t('app', 'Language Code'),
            'menu_id' => Yii::t('app', 'Menu ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenu()
    {
        return $this->hasOne(Menu::className(), ['id' => 'menu_id']);
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
