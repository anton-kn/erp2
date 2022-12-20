<?php

namespace app\controllers;

use app\models\Visit;
use app\models\VisitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Lesson;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;

/**
 * VisitController implements the CRUD actions for Visit model.
 */
class VisitController extends Controller {

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
                [
                    'access' => [
                        'class' => AccessControl::class,
                        'only' => ['logout', 'index', 'create', 'update', 'view', 'delete'],
                        'rules' =>
                        [
                            [
                                'actions' => ['logout', 'index'],
                                'allow' => true,
                                'matchCallback' => function ($rule, $action) use ($user) {
                                    return $user->is_admin;
                                },
                                'roles' => ['@'],
                            ],
                            [
                                'actions' => ['logout', 'index'],
                                'allow' => true,
                                'matchCallback' => function ($rule, $action) use ($user) {
                                    return $user->type == User::getTeacher();
                                },
                                'roles' => ['@'],
                            ],
                            [
                                'actions' => ['logout', 'index', 'create', 'update', 'view', 'delete'],
                                'allow' => true,
                                'matchCallback' => function ($rule, $action) use ($user) {
                                    return $user->type == User::getStudent();
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
     * Lists all Visit models.
     *
     * @return string
     */
    public function actionIndex() {
        $searchModel = new VisitSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Visit model.
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
     * Creates a new Visit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($lessonId) {
        $model = new Visit();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        $lesson = Lesson::findOne($lessonId);
        $userIdentity = User::getIdentityUser();
        $student = User::find()->where(['id' => $userIdentity->id])->one();

        return $this->render('create', [
                    'model' => $model,
                    'lesson' => $lesson,
                    'student' => $student,
                    'rate' => Visit::rateLesson(),
        ]);
    }

    /**
     * Updates an existing Visit model.
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

        $lesson = Lesson::findOne($id);
        $userIdentity = User::getIdentityUser();
        $student = User::find()->where(['id' => $userIdentity->id])->one();

        return $this->render('update', [
                    'model' => $model,
                    'lesson' => $lesson,
                    'student' => $student,
                    'rate' => Visit::rateLesson(),
        ]);
    }

    /**
     * Deletes an existing Visit model.
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
     * Отмечает студентов на занятии
     */
    public function actionVisitStudents($lessonId) {
        $model = new Visit();
        
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->render('visit-students', [
                    'model' => $model,
                    'students' => User::studentsByLesson($lessonId),
                    'lesson' => Lesson::findOne($lessonId),
                    'visit' => $model->find(),
                    'lessonId' => $lessonId,
                ]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('visit-students', [
            'model' => $model,
            'students' => User::studentsByLesson($lessonId),
            'lesson' => Lesson::findOne($lessonId),
            'visit' => $model->find(),
            'lessonId' => $lessonId,
        ]);
    }

    /**
     * Finds the Visit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Visit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Visit::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
