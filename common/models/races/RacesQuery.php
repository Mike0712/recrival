<?php

namespace common\models\races;

/**
 * This is the ActiveQuery class for [[Race]].
 *
 * @see Race
 */
class RacesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Race[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Race|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
