<?php

namespace app\controllers;

use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;
use app\models\UserSearch;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller {

    private function getUser(): ?User {
        return Yii::$app->user->isGuest ? null : Yii::$app->user->identity->user;
    }

    /**
     * @inheritDoc
     */
    public function behaviors() {
        $user = $this->getUser();
        return array_merge(
                parent::behaviors(),
                ['access' => [
                        'class' => AccessControl::class,
                        'only' => ['logout', 'index', 'create', 'update', 'view', 'delete'],
                        'rules' =>
                        [
                            [
                                'actions' => ['logout', 'index', 'create', 'update', 'view', 'delete'],
                                'allow' => true,
                                'matchCallback' => function ($rule, $action) use ($user) {
                                    return $user->is_admin;
                                },
                                'roles' => ['@'],
                            ],
                            [
                                'actions' => ['logout'],
                                'allow' => true,
                                'matchCallback' => function ($rule, $action) use ($user) {
                                    return $user->type == User::getTeacher();
                                },
                                'roles' => ['@'],
                            ],
                            [
                                'allow' => true,
                                'actions' => ['login'],
                                'roles' => ['?'],
                            ],
                        ],
                    ],
                    'verbs' => [
                        'class' => VerbFilter::className(),
                        'actions' => [
                            'delete' => ['POST'],
                        ],
                    ],
                ]
        );
    }

    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex($type) {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
//        echo '<pre>';
//        var_dump($this->request->queryParams['type']);
//        echo '</pre>';
//        exit();
        
//        $dataProvider = new ActiveDataProvider([
//            'query' => User::find()->where(['type' => $type]),
//                /*
//                  'pagination' => [
//                  'pageSize' => 50
//                  ],
//                  'sort' => [
//                  'defaultOrder' => [
//                  'id' => SORT_DESC,
//                  ]
//                  ],
//                 */
//        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate() {
        $model = new User();

        if ($this->request->isPost) {
            $model->beforeSave(true);
            if ($model->load($this->request->post()) && $model->save()) {

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Такой страницы не существует!');
    }

}
