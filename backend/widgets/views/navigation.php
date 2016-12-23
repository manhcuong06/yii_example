<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="leftpanel">
    <div class="media profile-left">
        <?= Html::a(
                Html::img($worker->image_id ? $worker->image->url : '/public/img/no_image.svg', ['class' => 'img-circle']),
                Url::to(['/worker/view', 'id' => $worker->id]),
                [
                    'class' => 'pull-left profile-thumb',
                ]
        ) ?>
        <div class="media-body">
            <h4 class="media-heading"><?= $worker->name ?></h4>
            <small class="text-muted">Code Lover</small>
        </div>
    </div>

    <h5 class="leftpanel-title">Navigation</h5>
    <ul class="nav nav-pills nav-stacked">
        <li id="site"><?= Html::a('<i class="fa fa-home"></i> <span>Home</span>', '/') ?></li>
        <li id="product"><?= Html::a('<i class="fa fa-laptop"></i> <span>Product</span>', '/product') ?></li>
        <li id="worker"><?= Html::a('<i class="fa fa-user"></i> <span>Worker</span>', '/worker') ?></li>
        <li id="user"><?= Html::a('<i class="fa fa-users"></i> <span>User</span>', '/user') ?></li>

        <li><a href="/"><i class="fa fa-home"></i> <span>Home</span></a></li>
        <li><a href="/product"><span class="pull-right badge">5</span><i class="fa fa-envelope-o"></i> <span>Messages</span></a></li>
        <li class="parent"><a href="#"><i class="fa fa-suitcase"></i> <span>UI Elements</span></a>
            <ul class="children">
                <li><a href="/">Alerts &amp; Notifications</a></li>
                <li><a href="/">Buttons</a></li>
                <li><a href="/">Extras</a></li>
                <li><a href="/">Graphs &amp; Charts</a></li>
                <li><a href="/">Icons</a></li>
                <li><a href="/">Modals</a></li>
                <li><a href="/">Panels &amp; Widgets</a></li>
                <li><a href="/">Sliders</a></li>
                <li><a href="/">Tabs &amp; Accordions</a></li>
                <li><a href="/">Typography</a></li>
            </ul>
        </li>
        <li class="parent"><a href="#"><i class="fa fa-edit"></i> <span>Forms</span></a>
            <ul class="children">
                <li><a href="code-editor.html">Code Editor</a></li>
                <li><a href="general-forms.html">General Forms</a></li>
                <li><a href="form-layouts.html">Layouts</a></li>
                <li><a href="wysiwyg.html">Text Editor</a></li>
                <li><a href="form-validation.html">Validation</a></li>
                <li><a href="form-wizards.html">Wizards</a></li>
            </ul>
        </li>
        <li class="parent"><a href="#"><i class="fa fa-bars"></i> <span>Tables</span></a>
            <ul class="children">
                <li><a href="basic-tables.html">Basic Tables</a></li>
                <li><a href="data-tables.html">Data Tables</a></li>
            </ul>
        </li>
        <li><a href="maps.html"><i class="fa fa-map-marker"></i> <span>Maps</span></a></li>
        <li class="parent"><a href="#"><i class="fa fa-file-text"></i> <span>Pages</span></a>
            <ul class="children">
                <li><a href="notfound.html">404 Page</a></li>
                <li><a href="blank.html">Blank Page</a></li>
                <li><a href="calendar.html">Calendar</a></li>
                <li><a href="invoice.html">Invoice</a></li>
                <li><a href="locked.html">Locked Screen</a></li>
                <li><a href="media-manager.html">Media Manager</a></li>
                <li><a href="people-directory.html">People Directory</a></li>
                <li><a href="profile.html">Profile</a></li>
                <li><a href="search-results.html">Search Results</a></li>
                <li><a href="signin.html">Sign In</a></li>
                <li><a href="signup.html">Sign Up</a></li>
            </ul>
        </li>
    </ul>
</div>
<script>
    var active_li = $('ul.nav.nav-pills.nav-stacked li#' + <?= '\''.Yii::$app->controller->id.'\'' ?>);
    active_li.addClass('active');
</script>