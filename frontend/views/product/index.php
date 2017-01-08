<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <div class="wrapper">
        <h1 class="title"><?= Html::encode($this->title) ?></h1>
        <span><i class="shopping-cart"></i></span>
        <div class="clear"></div>
        <div class="items">
        <?php foreach ($products as $product) { ?>
            <div class="item">
                <img src="<?= isset($product->image->id) ? $product->image->url : '' ?>" alt="item" />
                <h2>Item <?= $product->name ?></h2>
                <p>Price: <em><?= $product->price ?> VNĐ</em></p>
                <button class="add-to-cart" type="button">Add to cart</button>
            </div>
        <?php } ?>
        </div>
    </div>

</div>

<script src="public/js/flying_cart.js"></script>