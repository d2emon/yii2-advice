<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model d2emon\advice\models\Advice */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('advice', 'Advices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advice-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('advice', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('advice', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('advice', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
	    [
	      'attribute' => 'description',
	      'format' => 'raw',
	      'value' => ($model->avatar ? Html::img('/images/advices/'.$model->avatar, ['align' => 'left']).' ' : '')
	        .$model->description,
	    ],
        ],
    ]) ?>

</div>
