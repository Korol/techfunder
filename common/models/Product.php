<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $asin
 * @property string $url
 * @property string $title
 * @property string $formatted_price
 * @property string $picture
 * @property string $ean
 * @property string $brand
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['asin'], 'required'],
            [['asin', 'ean', 'formatted_price'], 'string', 'max' => 20],
            [['title', 'picture', 'brand', 'url'], 'string', 'max' => 255],
            [['asin'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'asin' => 'ASIN',
            'title' => 'Title',
            'formatted_price' => 'Price',
            'picture' => 'Picture',
            'ean' => 'EAN',
            'brand' => 'Brand',
            'url' => 'URL',
        ];
    }
}
