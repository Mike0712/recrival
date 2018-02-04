<?php

namespace common\models\clubs;

/**
 * This is the ActiveQuery class for [[Club]].
 *
 * @see Club
 */
class ClubsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Club[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Club|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
