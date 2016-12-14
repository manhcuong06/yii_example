<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use backend\widgets\MenuTopWidget;
use backend\widgets\NavigationWidget;

AppAsset::register($this);

$body_class = Yii::$app->user->isGuest ? 'signin' : '';
$icon_name = Yii::$app->params['icons'][Yii::$app->controller->id];
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script src="/public/js/jquery-1.11.1.min.js"></script>
</head>
<body class='<?= $body_class ?>'>
<?php $this->beginBody() ?>

<?php if(Yii::$app->user->isGuest) { ?>
    <?= Alert::widget() ?>
    <?= $content ?>
<?php } else { ?>
<?= MenuTopWidget::widget() ?>
<section>
    <div class="mainwrapper">
        <?= NavigationWidget::widget() ?>
        <div class="mainpanel">
            <div class="pageheader">
                <div class="media">
                    <div class="pageicon pull-left">
                        <i class="fa fa-<?= $icon_name ?>"></i>
                    </div>
                    <div class="media-body">
                        <ul class="breadcrumb">
                            <?= Breadcrumbs::widget([
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                'homeLink' => [
                                    'label' => '<i class="glyphicon glyphicon-home"></i>',
                                    'encode' => false,
                                    'url' => '/',
                                ],
                            ]) ?>
                        </ul>
                        <h4><?= $this->title ?></h4>
                    </div>
                </div>
            </div>
            <div class="contentpanel">
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>
    </div>
</section>
<?php } ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
