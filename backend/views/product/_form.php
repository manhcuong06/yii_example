<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use dosamigos\ckeditor\CKEditor;
use dosamigos\ckeditor\CKEditorInline;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin([
        'fieldClass' => 'backend\widgets\_ActiveField',
        'method'     => 'POST',
        'options'    => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, 'name')->textInput()->icon('keyboard-o') ?>

    <?= $form->field($model, 'category_id')->widget(Select2::className(), [
        'name' => 'Product[category_id]',
        'data'  => $categories,
        'value' => $model->category_id,
        'pluginOptions' => [
            'placeholder' => 'Choose Category',
        ],
    ])->icon('desktop') ?>

    <?= $form->field($model, 'summary')->textarea(['rows' => 6])->icon('info-circle') ?>

    <?= $form->field($model, 'detail')->widget(CKEditor::className(), [
        'options' => [
            'id' => 'detail-textarea',
            'rows' => 6,
        ],
        'preset' => 'custom',
    ])->icon('info-circle') ?>

    <?= $form->field($model, 'price')->textInput()->icon('dollar') ?>

    <?php if ($model->image) { ?>
    <div class="form-group">
        <?= Html::img("/public/img/product/$model->image", [
            'width' => 150,
            'height' => 150,
        ]) ?>
    </div>
    <?php } ?>
    <div class="form-group">
        <label for="product_image">Image</label>
        <?= Html::fileInput('product_image', '', [
            'id' => 'product_image',
            'required' => $model->isNewRecord,
        ]) ?>
    </div>

    <?= $form->field($model, 'is_new')->checkbox()->checkboxCustom('success')?>

    <?= $form->field($model, 'views')->textInput([
        'readonly' => true,
        'value' => $model->views ? $model->views : 0,
    ])->icon('info') ?>

    <?= $form->field($model, 'created_at')->widget(DatePicker::className(), [
        'value' => $model->created_at,
        'type'  => DatePicker::TYPE_COMPONENT_PREPEND,
        'pluginOptions' => [
            'autoclose'   => true,
            'format'      => 'yyyy-mm-dd',
        ],
    ]) ?>

    <?= $form->field($model, 'status')->checkbox()->checkboxCustom('primary')->label('In stock') ?>

    <?= $form->field($model, 'discount')->widget(CKEditor::className(), [
        'options' => [
            'id' => 'discount-textarea',
            'rows' => 6,
        ],
        'preset' => 'custom',
    ])->icon('ticket') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['id' => 'submit', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>