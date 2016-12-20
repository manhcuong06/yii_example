<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

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
                'value' => '<img src="'.$model->image->url.'" width=100 height=100>',
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

</div>
