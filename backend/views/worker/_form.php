<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use kartik\file\FileInput;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model backend\models\Worker */
/* @var $form yii\widgets\ActiveForm */

if ($model->isNewRecord) {
    $model->status = User::STATUS_ACTIVE;
}
?>

<div class="worker-form">

    <?php $form = ActiveForm::begin([
    	'fieldClass' => 'backend\widgets\_ActiveField',
    	'method'     => 'POST',
        'options'    => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->icon('user') ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true])->icon('envelope') ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true])->icon('phone') ?>

    <?= $form->field($model, 'password')->passwordInput()->icon('lock') ?>

    <?php $image_params = [
        'name' => 'Worker[image_id]',
        'pluginOptions' => [
            'uploadUrl' => ['/worker/update', 'id' => $model->id],
            'initialPreview' => [
                ($model->image) ? '/public/img/photos/'.$model->image->url : null,
            ],
            'initialPreviewAsData' => true,
            'initialPreviewConfig' => [
                ['caption' => $model->image->name, 'size' => '873727'],
            ],
            'showUpload'  => false,
            'browseClass' => 'btn btn-success',
            'removeClass' => 'btn btn-danger',
        ],
    ];?>
    <?= ($model->isNewRecord) ? $form->field($model, 'image_id')->widget(FileInput::classname(), $image_params) : FileInput::widget($image_params)?>

    <?= $form->field($model, 'status')->widget(Select2::className(), [
        'data'  => [User::STATUS_DELETED => 'Deactive', User::STATUS_ACTIVE => 'Active'],
        'value' => $model->status,
        'pluginOptions' => [
            'placeholder' => 'Choose Status',
        ],
    ])->icon('key') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['id' => 'submit', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>