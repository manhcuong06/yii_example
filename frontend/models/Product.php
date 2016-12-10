<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property string $summary
 * @property string $detail
 * @property integer $price
 * @property string $image
 * @property integer $is_new
 * @property integer $views
 * @property integer $created_at
 * @property integer $status
 * @property string $discount
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
            [['category_id', 'name', 'summary', 'detail', 'price', 'image', 'created_at'], 'required'],
            [['category_id', 'price', 'is_new', 'views', 'created_at', 'status'], 'integer'],
            [['summary', 'detail', 'discount'], 'string'],
            [['name'], 'string', 'max' => 64],
            [['image'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'name' => 'Name',
            'summary' => 'Summary',
            'detail' => 'Detail',
            'price' => 'Price',
            'image' => 'Image',
            'is_new' => 'Is New',
            'views' => 'Views',
            'created_at' => 'Created At',
            'status' => 'Status',
            'discount' => 'Discount',
        ];
    }

    /**
     * @inheritdoc
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }
}
