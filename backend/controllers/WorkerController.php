<?php

namespace backend\controllers;

use Yii;
use backend\models\Worker;
use backend\models\WorkerSearch;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

/**
 * WorkerController implements the CRUD actions for Worker model.
 */
class WorkerController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access'    => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions'   => ['index', 'view', 'update', 'create', 'delete', 'confirm'],
                        'allow'     => true,
                        'roles'     => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete'  => ['POST'],
                    'confirm' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Worker models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WorkerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Worker model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Worker model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Worker();

        if ($model->load(Yii::$app->request->post())) {
            $password = Yii::$app->request->post('Worker')['password'];
            $image = $this->uploadImage();
            if ($result = $model->savePasswordAndImage($password, $image)) {
                return $this->redirect(['view', 'id' => $result->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Worker model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $password = Yii::$app->request->post('Worker')['password'];
            if ($image = $this->uploadImage()) {
                $this->deleteImage($model->image);
            }
            if ($result = $model->savePasswordAndImage($password, $image)) {
                return $this->redirect(['view', 'id' => $result->id]);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Worker model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->deleteImage($model->image);
        $model->delete();

        return $this->redirect(['index']);
    }

    public function actionConfirm($id)
    {
        $model = $this->findModel($id);
        $model->status = User::STATUS_ACTIVE;
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Worker model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Worker the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Worker::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function uploadImage()
    {
        if ($file = UploadedFile::getInstanceByName('Worker[image]')) {
            $full_name = date('Y-m-d_H-i-s').'_'.$file->name;
            $file->saveAs('public/img/photos/'.$full_name);
            return $full_name;
        }
        return '';
    }

    protected function deleteImage($image)
    {
        if ($image) {
            $path = 'public/img/photos/'.$image ;
            if (file_exists($path)) {
                unlink($path);
            }
        }
    }
}
