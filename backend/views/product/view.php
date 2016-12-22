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
    <?php foreach ($comments as $comment) { ?>
    <div class="comment-block col-sm-12">
        <div class="image col-sm-2">
            <?= Html::img(($comment->worker_id && $comment->worker->image) ? $comment->worker->image->url : '/public/img/no_image.svg', [
                'width'  => 100,
                'height' => 100,
            ]) ?>
        </div>
        <div class="info col-sm-10">
            <div class="name"><?= Html::a($comment->worker->name, '#') ?></div>
            <div class="content"><b><?= $comment->content ?></b></div>
            <div class="time">Post at: <?= $comment->created_at ?></div>
        </div>
    </div>
    <?php } ?>

    <label class="comment-label">Make you comment:</label>
    <?php $form = ActiveForm::begin([
        'fieldClass' => 'backend\widgets\_ActiveField',
        'method'     => 'POST',
        'action'     => ['/product/comment', 'id' => $model->id],
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
