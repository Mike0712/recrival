<?php

namespace common\models\races;

/**
 * This is the ActiveQuery class for [[RaceTime]].
 *
 * @see RaceTime
 */
class RaceTimesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return RaceTime[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return RaceTime|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
