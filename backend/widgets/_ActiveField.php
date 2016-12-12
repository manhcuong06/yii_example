<?php

namespace backend\widgets;

use yii\bootstrap\ActiveField;

class _ActiveField extends ActiveField
{
    public function init()
    {
        parent::init();
    }

    public function icon($icon)
    {
        $this->template =
            "{label}
            <div class='input-group mb15'>
                <span class='input-group-addon'><i class=\"glyphicon glyphicon-{icon}\"></i></span>
                {input}
            </div>
            {error}"
        ;
        $this->parts['{icon}'] = $icon;
        return $this;
    }

    public function checkboxCustom($class)
    {
        $this->options = ['class' => 'ckbox ckbox-'.$class];
        $this->template = "{input}\n{label}\n{error}\n{hint}";
        return $this;
    }
}