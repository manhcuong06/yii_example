<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Request password reset';
?>
<div class="site-request-password-reset">
    <div class="panel panel-signin">
        <div class="panel-body">
            <h4 class="text-center mb5">Forgot Password</h4>
            <p class="text-center">Please fill out your email.</p>
            <?php $form = ActiveForm::begin([
                'id' => 'request-password-reset-form',
                'fieldClass' => 'backend\widgets\_ActiveField',
            ]); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true])->icon('envelope') ?>

                <div class="form-group">
                    <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>