<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $phone;
    public $agreement;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password', 'password_confirmation'], 'required'],
            [['name', 'email', 'phone'], 'trim'],
            ['name', 'string', 'min' => 2, 'max' => 255],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User'],
            ['password', 'string', 'min' => 6],
            ['password_confirmation', 'compare', 'compareAttribute' => 'password'],
            ['agreement', 'integer', 'min' => 1, 'tooSmall' => 'You have to agree with the Terms and Conditions.'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->name   = $this->name;
        $user->email  = $this->email;
        $user->phone  = $this->phone;
        $user->image  = 'user1.png';
        $user->status = User::STATUS_DELETED;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }
}
