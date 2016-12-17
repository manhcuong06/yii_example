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
 * @property string $image
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
            [['name', 'email'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
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
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'status' => 'Status',
            'image' => 'Image',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }


    public function savePasswordAndImage($password = null, $image = null)
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
        if (!$this->id || $password) {
            $user->setPassword($password);
            $user->generateAuthKey();
        }
        if ($image) {
            $user->image = $image;
        }

        // save
        if (!$user->save()) {
            return null;
        }

        return $user;
    }
}
