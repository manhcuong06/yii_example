<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <div class="panel panel-signup">
        <div class="panel-body">
            <div class="logo text-center">
                <img src="/public/img/logo-primary.png" alt="Chain Logo" >
            </div>
            <br />
            <h4 class="text-center mb5">Create a new account</h4>
            <p class="text-center">Please enter your credentials below</p>

            <div class="mb30"></div>

            <?php $form = ActiveForm::begin([
                'id' => 'signup-form',
                'fieldClass' => 'backend\widgets\_ActiveField',
            ]); ?>

            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'name')->textInput(['autofocus' => true])->icon('user') ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'phone')->textInput()->icon('phone') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <?= $form->field($model, 'email')->textInput()->icon('envelope') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'password')->passwordInput()->icon('lock') ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'password_confirmation')->passwordInput()->icon('lock') ?>
                </div>
            </div>
            <div class="clearfix">
                <div class="pull-left">
                    <?= $form->field($model, 'agreement')->checkbox()->label('I agree with '.Html::a('Terms and Conditions', '#'))->checkboxCustom('primary') ?>
                </div>
                <div class="pull-right">
                    <?= Html::submitButton('Create New Account <i class="fa fa-angle-right ml5"></i>', ['class' => 'btn btn-success', 'name' => 'signup-button']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
        <div class="panel-footer">
            <?= Html::a('Already a Member? Sign In', 'login', [
                'class' => 'btn btn-primary btn-block',
            ]) ?>
        </div>
    </div>
    </div>
</div>
