<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('advice', 'Advices');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advice-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('advice', 'Create Advice'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'title',
	    [
	      'attribute' => 'description',
	      'format' => 'raw',
	      'value' => function($model){
	           $avatar = $model->avatar ? Html::img($model->avatar, ['align' => 'left']).' ' : '';
		   return $avatar.StringHelper::truncate($model->description, 128);
	      },
	    ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
