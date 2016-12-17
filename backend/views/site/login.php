<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\authclient\widgets\AuthChoice;

$this->title = 'Login';
$this->registerCssFile('/public/css/bootstrap-social.css');
?>
<div class="site-login">
    <div class="panel panel-signin">
        <div class="panel-body">
            <div class="logo text-center">
                <img src="/public/img/logo-primary.png" alt="Chain Logo" >
            </div>
            <br />
            <h4 class="text-center mb5">Already a Member?</h4>
            <p class="text-center">Sign in to your account</p>

            <div class="mb30"></div>
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'fieldClass' => 'backend\widgets\_ActiveField',
            ]); ?>
            <?= $form->field($model, 'email')->textInput(['autofocus' => true])->icon('envelope') ?>

            <?= $form->field($model, 'password', [
            ])->passwordInput()->icon('lock') ?>

            <div class="clearfix">
                <div class="pull-left">
                    <?= $form->field($model, 'rememberMe')->checkbox()->checkboxCustom('primary') ?>
                </div>
                <div class="pull-right">
                    <?= Html::submitButton('Sign In <i class="fa fa-sign-in ml5"></i>', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

            <?php $authAuthChoice = AuthChoice::begin(['baseAuthUrl' => ['site/auth'],]); ?>
            <ul>
            <?php foreach ($authAuthChoice->getClients() as $client) { ?>
                <li><?= $authAuthChoice->clientLink($client, '<span class="fa fa-'.$client->getName().'"></span> Sign in with '.$client->getTitle(), ['class' => 'btn btn-block btn-social btn-'.$client->getName(),]) ?></li>
            <?php } ?>
            </ul>
            <?php AuthChoice::end(); ?>
        </div>
        <div class="panel-footer">
            <?= Html::a('Not yet a Member? Create Account Now', 'signup', [
                'class' => 'btn btn-primary btn-block',
            ]) ?>
        </div>
    </div>
</div>
