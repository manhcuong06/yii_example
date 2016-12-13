<?php

namespace backend\widgets;

use Yii;
use yii\base\Widget;
use backend\models\Worker;

class NavigationWidget extends Widget
{
	public function init()
	{
		parent::init();
	}

	public function run()
	{
		$worker = Worker::findOne(Yii::$app->user->id);
        return $this->render('navigation', [
        	'worker' => $worker,
        ]);
	}
}
