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
}
