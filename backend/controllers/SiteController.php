<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\SignupForm;
use common\models\LoginForm;
use common\models\User;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'signup', 'error', 'auth'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successCallback'],
                'successUrl' => '/',
            ],
        ];
    }

    public function successCallback($client)
    {
        $attributes = $client->getUserAttributes();
        switch (Yii::$app->request->get('authclient')) {
            case 'google':
                $email = $attributes['emails'][0]['value'];
                $name  = $attributes['displayName'];
                break;
            case 'linkedin':
                $email = $attributes['email'];
                $name  = $attributes['first_name'].' '.$attributes['last_name'];
                break;
            default:
                $email = $attributes['email'];
                $name  = $attributes['name'];
                break;
        }
        $identity = User::findByEmail($email);
        if (isset($identity)) {
            Yii::$app->user->login($identity);
        }
        else {
            $params['SignupForm'] = [
                'name'     => $name,
                'phone'    => 0,
                'email'    => $email,
                'password' => $attributes['id'],
                'password_confirmation' => $attributes['id'],
            ];
            $model = new SignupForm();
            $model->load($params);
            $user = $model->signup();
            Yii::$app->session->setFlash('success', 'Create account successfully. Please wait for confimation.');
        }
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signup action.
     *
     * @return string
     */
    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Create account successfully. Please wait for confimation.');
            return $this->goHome();
        } else {
            return $this->render('signup', [
                'model' => $model,
            ]);
        }
    }
}
