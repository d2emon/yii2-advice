<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model d2emon\advice\models\Advice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="advice-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php /* <?= $model->avatar ? Html::img($model->avatar) : '' ?> */ ?>
    <?php /* <?= $form->field($model, 'imageFile')->fileInput() ?> */ ?>
    <?php $extra = $model->isNewRecord ? [] : ['advice_id' => $model->id]; ?>
    <?= $form->field($model, 'imageFile')->widget(FileInput::classname(), [
	'options' => [
	    'multiple' => False,
	    'accept' => 'image/*',
	],
	'pluginOptions' => [
	    'uploadUrl' => Url::to(['/advice/default/upload']),
            'uploadExtraData' => $extra,
	    // 'initialPreview' => [$model->avatar],
	    // 'initialPreviewAsData' => True,
	    // 'initialCaption' => $model->image,
	    'overwriteInitial' => True,
	    'showClose' => False,
	    'showCaption' => False,
	    'showBrowse' => False,
	    'browseOnZoneClick' => True,
	    'removeLabel' => '',
	    'removeIcon' => '<i class="glyphicon glyphicon-remove"></i>',
	    'removeTitle' => 'Cancel or reset',
	    'defaultPreviewContent' => Html::img($model->avatar, ['width' => 64, 'height' => 64]),
	    'layoutTemplates' => [
	        'main2' => '{preview} {remove} {browse}',
	    ],
    	],
    ]); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('advice', 'Create') : Yii::t('advice', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
