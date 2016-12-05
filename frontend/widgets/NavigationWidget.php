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
        return $this->render('navigation');
	}
}
