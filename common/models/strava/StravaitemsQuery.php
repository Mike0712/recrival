<?php

namespace common\models\strava;

/**
 * This is the ActiveQuery class for [[Strava]].
 *
 * @see Strava
 */
class StravaitemsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Strava[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Strava|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
