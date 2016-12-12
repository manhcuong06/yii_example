<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin([
        'fieldClass' => 'backend\widgets\_ActiveField',
    ]); ?>

    <?= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'summary')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <?php if ($model->image) { ?>
    <div class="form-group">
        <?= Html::img("/public/img/product/$model->image", [
            'width' => 150,
            'height' => 150,
        ]) ?>
    </div>
    <?php } ?>
    <div class="form-group">
        <label for="product-image">Image</label>
        <?= Html::fileInput('product-image', '', [
            'id' => 'product-image',
        ]) ?>
    </div>

    <?= $form->field($model, 'is_new')->checkbox()->checkboxCustom('success')?>

    <?= $form->field($model, 'views')->textInput() ?>

    <?= $form->field($model, 'created_at')->widget(DatePicker::className(), [
        'value' => $model->created_at,
        'type'  => DatePicker::TYPE_COMPONENT_APPEND,
        'pluginOptions' => [
            'autoclose' => true,
            'format'    => 'yyyy-mm-dd',
        ],
    ]) ?>

    <?= $form->field($model, 'status')->checkbox()->checkboxCustom('primary')->label('In stock') ?>

    <?= $form->field($model, 'discount')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>