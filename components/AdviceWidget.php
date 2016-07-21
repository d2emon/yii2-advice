<?php
namespace d2emon\advice\components;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use d2emon\advice\models\Advice;

class AdviceWidget extends Widget
{
    public $advice;
    public $advice_id;
    public $image_options;
    public $image_size;
    public $truncate;
    public $show_title;

    public function init()
    {
        parent::init();
        if ($this->advice_id === null) {
            $this->advice_id = 0;
        }
	if ($this->image_options === null) {
	    $this->image_options = [
		'align' => 'left',
		'width' => 0,
		'height' => 0,
	    ];
	}
	if ($this->image_size === null) {
	    $this->image_size = 64;
	}
	if ($this->truncate === null) {
	    $this->truncate = 0;
	}
	if ($this->show_title === null) {
	    $this->show_title = True;
	}
    }

    public function run()
    {
	if($this->advice === null) {
            $this->advice = $this->advice_id ? Advice::findOne($this->advice_id) : Advice::find()->orderBy('rand()')->one();
	}

	if (!$this->advice) {
	    return '';
	}

	$options = $this->image_options;
        $options['width']  = $options['width']  ? $options['width']  : $this->image_size;
        $options['height'] = $options['height'] ? $options['height'] : $this->image_size;

	$title  = ($this->show_title && $this->advice->title) ? Html::a('<h1>'.Html::encode($this->advice->title)."</h1>\n", ['/advice/default/view', 'id' => $this->advice->id]) : '';
	$avatar = $this->advice->avatar ? Html::img($this->advice->avatar, $options).' ' : '';
        $desc   = $this->advice->description;
	if ($this->truncate) {
	    $desc = StringHelper::truncate($desc, 128);
	}	   
	return "<div class=\"advice\">".$title."<div class=\"advice_body\">".$avatar.nl2br($desc)."</div></div>";
    }
}

