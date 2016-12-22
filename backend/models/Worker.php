<?php

namespace backend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "worker".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property integer $image_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Worker extends \yii\db\ActiveRecord
{
    public $password;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'worker';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password'], 'required'],
            [['status', 'created_at', 'updated_at', 'image_id'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['email'], 'string', 'max' => 128],
            [['phone'], 'string', 'max' => 16],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token', 'auth_key'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
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
            'email' => 'Email',
            'phone' => 'Phone',
            'auth_key' => 'Auth Key',
            'password' => 'Password',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'status' => 'Status',
            'image_id' => 'Image',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id']);
    }

    public function savePassword($password = null)
    {
        // validate
        if (!$this->validate()) {
            return null;
        }

        // set parameter
        $user = $this->id ? User::findIdentity($this->id) : new User();
        $user->name   = $this->name;
        $user->email  = $this->email;
        $user->phone  = $this->phone;
        $user->status = $this->status;
        $user->image_id = $this->image_id;
        if (!$this->id || $password) {
            $user->setPassword($password);
            $user->generateAuthKey();
        }

        // save
        if (!$user->save()) {
            return null;
        }

        return $user;
    }
}
