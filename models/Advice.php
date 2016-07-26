<?php

namespace d2emon\advice\models;

use Yii;
use uxappetite\yii2image\components\ImageGroup;

/**
 * This is the model class for table "advice".
 *
 * @property integer $id
 * @property string $title
 * @property string $image
 * @property string $description
 */
class Advice extends \yii\db\ActiveRecord
{
    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'advice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 6],
	    [['imageFile'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('advice', 'ID'),
            'title' => Yii::t('advice', 'Title'),
            'image' => Yii::t('advice', 'Image'),
            'description' => Yii::t('advice', 'Description'),
        ];
    }

    public function upload()
    {
        if ((!$this->imageFile) && (Yii::$app->session->hasFlash('image'))){
	    $this->image = Yii::$app->session->getFlash('image');
	    return True;
	}
	Yii::$app->session->removeFlash('image');
	if (!$this->imageFile) {
	    return True;
	}
	if ($this->validate()) {
	    $group = Yii::$app->getModule('advice')->imageGroup;
	    $this->image = $group->replace($this->image, $this->imageFile);
	    /*
	    Image::thumbnail($imagePath.$filename, 64, 64)
		->save($imagePath.$imagename.'_s.jpg');
	     */
	    
	    $this->imageFile = null;
            return True;
        } else {
            return false;
        }
    }

    /**
     * Forms avatar
     *
     * @return string
     */
    public function getThumb($suffix='')
    {
	if (!$this->image)
	    return False;
	$group = Yii::$app->getModule('advice')->imageGroup;
	return '/'.$group->getFilename($this->image, $suffix);
    }
}
