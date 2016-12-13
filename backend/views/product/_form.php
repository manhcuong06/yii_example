<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\file\FileInput;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */

if ($model->isNewRecord) {
    $model->is_new     = 1;
    $model->views      = 0;
    $model->created_at = date('Y-m-d');
    $model->status     = 1;
}
?>

<div class="product-form">

    <?php $form = ActiveForm::begin([
        'fieldClass' => 'backend\widgets\_ActiveField',
        'method'     => 'POST',
        'options'    => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, 'name')->textInput()->icon('keyboard-o') ?>

    <?= $form->field($model, 'category_id')->widget(Select2::className(), [
        'name'  => 'Product[category_id]',
        'data'  => $categories,
        'value' => $model->category_id,
        'pluginOptions' => [
            'placeholder' => 'Choose Category',
        ],
    ])->icon('desktop') ?>

    <?= $form->field($model, 'summary')->textarea(['rows' => 6])->icon('info-circle') ?>

    <?= $form->field($model, 'detail')->widget(CKEditor::className(), [
        'options' => [
            'id'   => 'detail-textarea',
            'rows' => 6,
        ],
        'preset' => 'custom',
    ])->icon('info-circle') ?>

    <?= $form->field($model, 'price')->textInput(['type' => 'number'])->icon('dollar') ?>

    <?php $image_params = [
        'name' => 'Product[image]',
        'pluginOptions' => [
            'uploadUrl' => ['/product/update', 'id' => $model->id],
            'initialPreview' => [
                ($model->image) ? '/public/img/product/'.$model->image : null,
            ],
            'initialPreviewAsData' => true,
            'initialPreviewConfig' => [
                ['caption' => $model->image, 'size' => '873727'],
            ],
            'showUpload'  => false,
            'browseClass' => 'btn btn-success',
            'removeClass' => 'btn btn-danger',
        ],
    ];?>
    <?= ($model->isNewRecord) ? $form->field($model, 'image')->widget(FileInput::classname(), $image_params) : FileInput::widget($image_params)?>

    <?= $form->field($model, 'is_new')->checkbox()->checkboxCustom('success')?>

    <?= $form->field($model, 'views')->textInput([
        'readonly' => true,
        'value' => $model->views,
    ])->icon('info') ?>

    <?= $form->field($model, 'created_at')->widget(DatePicker::className(), [
        'value' => $model->created_at,
        'type'  => DatePicker::TYPE_COMPONENT_PREPEND,
        'pluginOptions' => [
            'autoclose' => true,
            'format'    => 'yyyy-mm-dd',
        ],
    ]) ?>

    <?= $form->field($model, 'status')->checkbox()->checkboxCustom('primary')->label('In stock') ?>

    <?= $form->field($model, 'discount')->widget(CKEditor::className(), [
        'options' => [
            'id'   => 'discount-textarea',
            'rows' => 6,
        ],
        'preset' => 'custom',
    ])->icon('ticket') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['id' => 'submit', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php if($model->isNewRecord) { ?>
<script>
$('#submit').on('click', function() {
    var image_input_hidden = $('.field-product-image input:not(#product-image)');
    var image = $('input#product-image');
    if (image.val()) {
        image_input_hidden.val(image.val());
        return true;
    }
    console.log(image_input_hidden, image_input_hidden.val());
    console.log(image, image.val());
    return false;
});
</script>
<?php } ?>