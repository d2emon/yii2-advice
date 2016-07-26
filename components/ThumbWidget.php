<?php
namespace d2emon\advice\components;

use yii\base\Widget;
use yii\helpers\Html;
use d2emon\advice\models\Advice;

class ThumbWidget extends \uxappetite\yii2image\components\ThumbWidget
{
    public $advice_id;

    public function init()
    {
        parent::init();
        if ($this->advice_id === null) {
            $this->advice_id = 0;
        }
	if (!isset($this->options['align'])) {
	    $this->options['align'] = 'left';
	}
    }

    public function run()
    {
	if($this->model === null) {
            $this->model = $this->advice_id ? Advice::findOne($this->advice_id) : Advice::find()->orderBy('rand()')->one();
	}
	return parent::run();
    }
}

