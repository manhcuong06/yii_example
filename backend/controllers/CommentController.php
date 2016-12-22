<?php

namespace backend\controllers;

use Yii;
use backend\models\Comment;
use backend\models\CommentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * CommentController implements the CRUD actions for Comment model.
 */
class CommentController extends Controller
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
                        'actions'   => ['index', 'create'],
                        'allow'     => true,
                        'roles'     => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index'  => ['POST'],
                    'create' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Comment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $product_id     = Yii::$app->request->post('id');
        $num_of_comment = Yii::$app->request->post('num_of_comment');
        $comments       = Comment::getCommentsByProductId($product_id);

        if ($num_of_comment != count($comments)) {
            $html = '';
            foreach ($comments as $comment) {
                $html .= '<div class="comment-block col-sm-12">';
                    $html .= '<div class="image col-sm-2">';
                        $html .= '<img src="'.($comment->worker->image_id ? $comment->worker->image->url : '').'" width=100 height=100 class="img-circle">';
                    $html .= '</div>';
                    $html .= '<div class="info col-sm-10">';
                        $html .= '<div class="name"><a href="#">'.$comment->worker->name.'</a></div>';
                        $html .= '<div class="content">'.$comment->content.'</div>';
                        $html .= '<div class="time">Post at: '.$comment->created_at.'</div>';
                    $html .= '</div>';
                $html .= '</div>';
            }
            return $html;
        }
        return null;
    }
    public function actionCreate($id)
    {
        $comment = new Comment();
        $comment->product_id = $id;
        $comment->worker_id  = Yii::$app->user->id;
        $comment->content    = Yii::$app->request->post('comment_content');
        $comment->created_at = date('Y-m-d H:i:s');
        $comment->save();
        return $this->redirect(['/product/view', 'id' => $id]);
    }
}
