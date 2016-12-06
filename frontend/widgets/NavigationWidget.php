<?php

namespace frontend\widgets;

use Yii;
use yii\base\Widget;

class NavigationWidget extends Widget
{
	public function init()
	{
		parent::init();
	}

	public function run()
	{
		$home_url = '';
		if (Yii::$app->controller->id != 'site' || Yii::$app->controller->action->id != 'index') {
			$home_url = Yii::$app->homeUrl;
		}
        return $this->render('navigation', [
        	'home_url' => $home_url,
        ]);
	}
}
