<?php

namespace backend\controllers;

use Yii;
use backend\models\Worker;
use backend\models\WorkerSearch;
use backend\models\Image;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
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

        if (isset($_FILES['worker_image']['tmp_name']) && $_FILES['worker_image']['tmp_name']) {
            $image = new Image();
            if (!$image->uploadToS3($_FILES['worker_image']) || !$image->save()) {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
            $model->image_id = $image->id;
        }
        if (!$model->load(Yii::$app->request->post()) || !$user = $model->savePassword(Yii::$app->request->post('Worker')['password'])) {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
        return $this->redirect(['view', 'id' => $user->id]);
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

        if (!$model->status) {
            throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }

        if (isset($_FILES['worker_image']['tmp_name']) && $_FILES['worker_image']['tmp_name']) {
            if ($model->image_id) {
                $image = $model->image;
                $image->deleteFromS3();
            } else {
                $image = new Image();
            }
            if (!$image->uploadToS3($_FILES['worker_image']) || !$image->save()) {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
            $model->image_id = $image->id;
        }
        if (!$model->load(Yii::$app->request->post()) || !$user = $model->savePassword(Yii::$app->request->post('Worker')['password'])) {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        return $this->redirect(['view', 'id' => $user->id]);
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
        if ($model->image_id) {
            $model->image->deleteFromS3();
            $model->image->delete();
        }
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
}
