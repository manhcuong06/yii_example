<?php

namespace backend\controllers;

use Yii;
use backend\models\Product;
use backend\models\ProductCategory;
use backend\models\ProductSearch;
use backend\models\Comment;
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
    protected $categories;
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
                        'actions'   => ['index', 'create', 'update', 'delete', 'view', 'comment'],
                        'allow'     => true,
                        'roles'     => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'comment' => ['POST'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }
        $this->categories = ArrayHelper::map(ProductCategory::find()->all(), 'id', 'name');
        
        return true;
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => $this->categories,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'categories' => $this->categories,
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

        if (isset($_FILES['product_image']['tmp_name']) && $_FILES['product_image']['tmp_name']) {
            $image = new Image();
            if (!$image->uploadToS3($_FILES['product_image']) || !$image->save()) {
                return $this->render('create', [
                    'model' => $model,
                    'categories' => $this->categories,
                ]);
            }
            $model->image_id = $image->id;
        }

        if (!$model->load(Yii::$app->request->post()) || !$model->save()) {
            return $this->render('create', [
                'model' => $model,
                'categories' => $this->categories,
            ]);
        }
        return $this->redirect(['view', 'id' => $model->id]);
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

        if (isset($_FILES['product_image']['tmp_name']) && $_FILES['product_image']['tmp_name']) {
            if ($model->image_id) {
                $image = $model->image;
                $image->deleteFromS3();
            } else {
                $image = new Image();
            }
            if (!$image->uploadToS3($_FILES['product_image']) || !$image->save()) {
                return $this->render('update', [
                    'model' => $model,
                    'categories' => $this->categories,
                ]);
            }
            $model->image_id = $image->id;
        }
        if (!$model->load(Yii::$app->request->post()) || !$model->save()) {
            return $this->render('update', [
                'model' => $model,
                'categories' => $this->categories,
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
        $model->image->deleteFromS3();
        $model->image->delete();
        $model->delete();

        return $this->redirect(['index']);
    }

    public function actionComment($id)
    {
        $comment = new Comment();
        $comment->product_id = $id;
        $comment->worker_id  = Yii::$app->user->id;
        $comment->content    = Yii::$app->request->post('comment_content');
        $comment->created_at = date('Y-m-d H:i:s');
        $comment->save();
        return $this->redirect(['view', 'id' => $id]);
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
