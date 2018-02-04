<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\persons\Person */

$this->title = Yii::t('persons', 'Create Person');
$this->params['breadcrumbs'][] = ['label' => Yii::t('persons', 'People'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
