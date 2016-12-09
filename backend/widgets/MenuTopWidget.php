<?php

namespace backend\widgets;

use Yii;
use yii\base\Widget;

class MenuTopWidget extends Widget
{
	public function init()
	{
		parent::init();
	}

	public function run()
	{
        return $this->render('menuTop');
	}
}
