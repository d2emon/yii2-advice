<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model d2emon\advice\models\Advice */

$this->title = Yii::t('advice', 'Create Advice');
$this->params['breadcrumbs'][] = ['label' => Yii::t('advice', 'Advices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advice-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
