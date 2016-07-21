<?php

namespace d2emon\advice;

/**
 * advice module definition class
 */
class Module extends \yii\base\Module
{
    public $baseImagePath = '/images/advices/';
    public $imagePath = '/web/images/advices/';
    public $uploadPath = '/web/uploads/';

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
}
