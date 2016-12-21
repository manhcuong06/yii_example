<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Worker */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Workers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="worker-view">

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
            'name',
            'email:email',
            'phone',
            [
                'attribute' => 'status',
                'value' => $model->status ? 'Active' : 'Deactive',
            ],
            [
                'attribute' => 'image_id',
                'format' => 'raw',
                'value' => Html::img($model->image_id ? $model->image->url : '/public/img/no_image.svg', [
                    'width'  => 100,
                    'height' => 100,
                ]),
            ],
        ],
    ]) ?>

</div>
