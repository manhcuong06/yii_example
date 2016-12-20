<?php

namespace backend\controllers;

use Yii;
use backend\models\Product;
use backend\models\ProductCategory;
use backend\models\ProductSearch;
use backend\models\Image;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
                        'actions'   => ['index', 'create', 'update', 'delete', 'view'],
                        'allow'     => true,
                        'roles'     => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $categories = ArrayHelper::map(ProductCategory::find()->all(), 'id', 'name');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => $categories,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $categories = ArrayHelper::map(ProductCategory::find()->all(), 'id', 'name');
        return $this->render('view', [
            'model' => $this->findModel($id),
            'categories' => $categories,
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        $categories = ArrayHelper::map(ProductCategory::find()->all(), 'id', 'name');

        if ($model->load(Yii::$app->request->post())) {
            $model->image = $this->uploadImage();
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'categories' => $categories,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $categories = ArrayHelper::map(ProductCategory::find()->all(), 'id', 'name');

        if (isset($_FILES['product_image']['tmp_name']) && $_FILES['product_image']['tmp_name']) {
            $image = new Image();
            if (!$image->uploadToS3($_FILES['product_image']['tmp_name']) || !$image->save()) {
                return $this->render('update', [
                    'model' => $model,
                    'categories' => $categories,
                ]);
            }
            $model->image_id = $image->id;
        }
        if (!$model->load(Yii::$app->request->post()) || !$model->save()) {
            return $this->render('update', [
                'model' => $model,
                'categories' => $categories,
            ]);
        }
        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Deletes an existing Product model.
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

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
