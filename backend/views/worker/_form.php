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

    <label class="control-label" for="worker-image_id">Image</label>
    <?= FileInput::widget([
        'name' => 'worker_image',
        'pluginOptions' => [
            'initialPreview' => [$model->image_id ? $model->image->url : null],
            'initialPreviewAsData' => true,
            'initialPreviewConfig' => [
                ['caption' => $model->image_id ? $model->image->name : '', 'size' => '873727'],
            ],
            'browseClass' => 'btn btn-success',
            'uploadClass' => 'btn btn-info',
            'removeClass' => 'btn btn-danger',
        ],
    ]) ?><br>

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