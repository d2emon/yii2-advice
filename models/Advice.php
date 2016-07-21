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
	if (!$this->imageFile) {
	    return True;
	}
        if ($this->validate()) {
	    $filename = $this->imageFile->baseName;	
	    $full_filename = $filename . '.' . $this->imageFile->extension;
	    $this->imageFile->saveAs('uploads/' . $full_filename);
            copy('uploads/'.$full_filename, 'images/advices/'.$full_filename);
	    $this->image = $filename;
	    $this->imageFile = null;
            return $this->save();
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
	return sprintf("%s.jpg", $this->image);
    }
}
