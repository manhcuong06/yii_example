<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $worker_id
 * @property string $content
 * @property integer $created_at
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'worker_id', 'content', 'created_at'], 'required'],
            [['product_id', 'worker_id'], 'integer'],
            [['content'], 'string'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'worker_id' => 'Worker ID',
            'content' => 'Content',
            'created_at' => 'Created At',
        ];
    }

    public function getWorker()
    {
        return $this->hasOne(Worker::className(), ['id' => 'worker_id']);
    }

    public static function getCommentsByProductId($product_id)
    {
        $comments = Comment::find()
            ->where(['product_id' => $product_id])
            ->orderBy(['created_at' => SORT_ASC])
            ->all()
        ;
        return $comments;
    }
}
