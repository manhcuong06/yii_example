<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>

    <h3>Back to home in <span class="text-danger">5</span> secconds</h3>

</div>
<script>
setInterval(function() {
    var second = $('.text-danger').text();
    $('.text-danger').text(second - 1);
    if (second == 1) {
        window.location = '/';
    }
}, 1000);
</script>