<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">
    <form class="form-horizontal form-bordered">
        ID <input type="text" id="id"/>
        Category <input type="text" id="category_id"/>
        Name <input type="text" id="name"/>
        Summary <input type="text" id="summary"/>
        Detail <input type="text" id="detail"/>
        Price <input type="text" id="price"/>
        Image <input type="text" id="image"/>
        Is new <input type="text" id="is_new"/>
        Views <input type="text" id="views"/>
        Created at <input type="text" id="created_at"/>
        Status <input type="text" id="status"/>
        Discount <input type="text" id="discount"/>
    </form>
</div>

<script>
var model = <?= $obj ?>;
for (var x in model){
    var input = $('input#' + x)[0].value = model[x];
}
</script>