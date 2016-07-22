<?php

namespace d2emon\advice\models;

use Yii;

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
	    $filename = $this->imageFile->baseName;	
	    $full_filename = $filename . '.' . $this->imageFile->extension;
	    $imagePath = Yii::$app->getModule('advice')->imagePath;
	    $uploadPath = Yii::$app->getModule('advice')->uploadPath;
	    $this->imageFile->saveAs($uploadPath.$full_filename);
	    copy($uploadPath.$full_filename, $imagePath.$full_filename);
	    $this->image = $filename;
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
    public function getAvatar()
    {
	if (!$this->image)
	    return False;
	return sprintf("%s%s.jpg", Yii::$app->getModule('advice')->baseImagePath, $this->image);
    }
}
