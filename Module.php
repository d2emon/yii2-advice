<?php

namespace d2emon\advice;

use Yii;

/**
 * advice module definition class
 */
class Module extends \yii\base\Module
{
    public $image_group_name = 'advice';

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'd2emon\advice\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public function getImageGroup()
    {
	return Yii::$app->getModule('image')->getImageGroup($this->image_group_name);
    }
}
