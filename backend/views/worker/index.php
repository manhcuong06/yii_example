<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\WorkerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Workers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="worker-index">

    <p>
        <?= Html::a('Create Worker', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function($model, $index, $key) {
                    return Html::a($model->name, ['view', 'id' => $index]);
                },
            ],
            'email:email',
            'phone',
            [
                'attribute' => 'status',
                'value' => function($model, $key, $index) {
                    return $model->status ? 'Active' : 'Deactive';
                },
                'filter' => Select2::widget([
                    'name'    => 'WorkerSearch[status]',
                    'data'    => [0 => 'Deactive', 10 => 'Active'],
                    'value'   => $searchModel->status,
                    'options' => [
                        'placeholder' => '',
                    ],
                ]),
            ],
            [
                'attribute' => 'image',
                'format' => 'raw',
                'value' => function($model, $key, $index) {
                    return Html::img("/public/img/photos/$model->image", [
                        'alt'    => 'image',
                        'width'  => 75,
                        'height' => 75,
                    ]);
                },
                'filter' => false,
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{confirm} {update} {delete}',
                'buttons' => [
                    'confirm' => function ($url, $model, $key) {
                        if ($model->status) {
                            return Html::a('<i class="fa fa-check"></i>', $url, [
                                'title' => 'Confirm',
                                'class' => 'btn btn-success',
                            ]);
                        }
                    },
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
