<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'category_id',
                'value' => 'category.name',
                'filter' => Select2::widget([
                    'name'    => 'ProductSearch[category_id]',
                    'data'    => $categories,
                    'value'   => $searchModel->category_id,
                    'options' => [
                        'placeholder' => '',
                    ],
                ]),
            ],
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function($model, $index, $key) {
                    return Html::a($model->name, ['view', 'id' => $index]);
                },
            ],

            'price',
            [
                'attribute' => 'image',
                'format' => 'raw',
                'value' => function($model, $key, $index) {
                    $path = "public/img/product/$model->image";
                    return Html::img(file_exists($path) ? $path : '', [
                        'alt'    => 'image',
                        'width'  => 50,
                        'height' => 50,
                    ]);
                },
                'contentOptions' => [
                    'style' => 'width: 100px;',
                ],
            ],
            [
                'attribute' => 'status',
                'value' => function($model, $index, $key) {
                    return Yii::$app->params['product_status'][$model->status];
                },
                'contentOptions' => function($model, $index, $key) {
                    $class = ($model->status) ? 'text-success' : 'text-danger';
                    return ['class' => $class];
                },
                'filter' => Select2::widget([
                    'name'    => 'ProductSearch[status]',
                    'data'    => Yii::$app->params['product_status'],
                    'value'   => $searchModel->status,
                    'options' => [
                        'placeholder' => '',
                    ],
                ]),
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-pencil"></i>', $url, [
                            'title' => 'Update',
                            'class' => 'btn btn-primary',
                        ]);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-trash-o"></i>', $url, [
                            'title' => 'Delete',
                            'class' => 'btn btn-danger',
                            'data-method'  => 'post',
                            'data-confirm' => 'Are you sure you want to delete this item?',
                        ]);
                    }
                ],
            ],
        ],
    ]); ?>
</div>
