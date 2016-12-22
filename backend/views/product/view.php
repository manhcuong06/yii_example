<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'category_id',
                'value' => $categories[$model->category_id],
            ],
            'name',
            'summary',
            'price',
            [
                'attribute' => 'image_id',
                'format' => 'raw',
                'value' => Html::img($model->image_id ? $model->image->url : '/public/img/no_image.svg', [
                    'width'  => 100,
                    'height' => 100,
                ]),
            ],
            [
                'attribute' => 'is_new',
                'value' => ($model->is_new) ? 'Yes' : 'No',
            ],
            'views',
            'created_at',
            [
                'attribute' => 'status',
                'value' => Yii::$app->params['product_status'][$model->status],
                'contentOptions' => [
                    'class' => $model->status ? 'text-success' : 'text-danger',
                ],
            ],
            'discount',
        ],
    ]) ?>

    <br><h1>Comment</h1>
    <div id="comment-section">
        <!-- Load comments here -->
    </div>

    <label class="comment-label">Make you comment:</label>
    <?php $form = ActiveForm::begin([
        'fieldClass' => 'backend\widgets\_ActiveField',
        'method'     => 'POST',
        'action'     => ['/comment/create', 'id' => $model->id],
    ]); ?>

    <?= CKEditor::widget([
        'name' => 'comment_content',
        'options' => ['rows' => 6],
        'preset' => 'custom',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Comment', ['id' => 'submit', 'class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
$(window).on('load', function() {
    getComments();
    setInterval(getComments, 10000);
});

function getComments() {
    var section = $('#comment-section');
    var num_of_comment = $('.comment-block').length;
    $.ajax({
        'url'    : '/comment',
        'method' : 'POST',
        'data'   : { id: <?= $model->id ?>, num_of_comment: num_of_comment }
    }).done(function(data) {
        if (data) {
            section.html(data);
        }
    });
}
</script>
