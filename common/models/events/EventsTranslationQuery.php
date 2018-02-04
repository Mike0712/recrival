<?php

namespace common\models\events;

/**
 * This is the ActiveQuery class for [[TranslationModel]].
 *
 * @see TranslationModel
 */
class EventsTranslationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TranslationModel[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TranslationModel|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
