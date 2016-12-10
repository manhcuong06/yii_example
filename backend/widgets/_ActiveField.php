<?php

namespace backend\widgets;

use yii\bootstrap\ActiveField;

class _ActiveField extends ActiveField
{

    public function init()
    {
        $this->template =
            "{label}
            <div class='input-group mb15'>
                <span class='input-group-addon'><i class=\"glyphicon glyphicon-{icon}\"></i></span>
                {input}
            </div>
            {error}"
        ;
        parent::init();
    }

    public function icon($content)
    {
        $this->parts['{icon}'] = $content;
        return $this;
    }
}