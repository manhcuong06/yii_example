<?php

namespace backend\models;

use Yii;
use Aws\S3\S3Client;

/**
 * This is the model class for table "image".
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'url'], 'required'],
            [['name', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'url' => 'Url',
        ];
    }

    public function uploadToS3($filepath)
    {
        $s3 = S3Client::factory([
            'credentials'   => Yii::$app->params['aws']['credentials'],
            'region'        => Yii::$app->params['aws']['region'],
            'version'       => Yii::$app->params['aws']['version'],
        ]);

        $name = date('Y-m-d_H-i-s');
        $response   = $s3->putObject([
            'Key'           => $name,
            'SourceFile'    => $filepath,
            'ACL'           => Yii::$app->params['aws']['acl'],
            'Bucket'        => Yii::$app->params['aws']['bucket'],
            'StorageClass'   => Yii::$app->params['aws']['storage_class'],
        ]);

        if (!$response) {
            return false;
        }

        $this->name = $name;
        $this->url  = $response['ObjectURL'];

        return true;
    }

    public function deleteFromS3()
    {
        $s3 = S3Client::factory([
            'credentials'   => Yii::$app->params['aws']['credentials'],
            'region'        => Yii::$app->params['aws']['region'],
            'version'       => Yii::$app->params['aws']['version'],
        ]);

        $response = $s3->deleteObject([
            'Bucket'    => Yii::$app->params['aws']['bucket'],
            'Key'       => $this->name,
        ]);

        if (!$response) {
            return false;
        }

        return true;
    }
}
