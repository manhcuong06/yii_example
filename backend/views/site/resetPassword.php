<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Reset password';
?>
<div class="site-reset-password">
    <div class="panel panel-signin">
        <div class="panel-body">
            <h4 class="text-center mb5">Reset Password</h4>
            <p class="text-center">Please choose your new password.</p>
            <?php $form = ActiveForm::begin([
                'id' => 'reset-password-form',
                'fieldClass' => 'backend\widgets\_ActiveField',
            ]); ?>

                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true])->icon('lock') ?>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>