<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model d2emon\advice\models\Advice */

$this->title = Yii::t('advice', 'Update {modelClass}: ', [
    'modelClass' => 'Advice',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('advice', 'Advices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('advice', 'Update');
?>
<div class="advice-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
