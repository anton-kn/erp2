<?php

namespace app\controllers;

use app\models\Lecture;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Course;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use app\models\CourseStudent;
use app\models\LectureSearch;
use app\models\Lesson;

/**
 * LectureController implements the CRUD actions for Lecture model.
 */
class LectureController extends Controller {

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
                                'actions' => ['logout', 'index', 'view'],
                                'allow' => true,
                                'matchCallback' => function ($rule, $action) use ($user) {
                                    return $user->is_admin;
                                },
                                'roles' => ['@'],
                            ],
                            [
                                'actions' => ['logout', 'index', 'create', 'update', 'view', 'delete'],
                                'allow' => true,
                                'matchCallback' => function ($rule, $action) use ($user) {
                                    return $user->type == User::getTeacher();
                                },
                                'roles' => ['@'],
                            ],
                            [
                                'actions' => ['logout', 'index'],
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
     * Lists all Lecture models.
     *
     * @return string
     */
    public function actionIndex() {
        $searchModel = new LectureSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $teacherIdentity = User::getIdentityUser();
        $course = Course::find()->where(['teacher_id' => $teacherIdentity->id]);
        $dataProviderCourse = new ActiveDataProvider([
            'query' => $course,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'dataProviderCourse' => $dataProviderCourse,
        ]);
    }

    /**
     * Displays a single Lecture model.
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
     * Creates a new Lecture model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate() {
        $teacher = User::getIdentityUser();
        $courses = Course::find()->where(['teacher_id' => $teacher->id])->all();
        $courseList = [];
        foreach ($courses as $course) {
            $courseList[$course->id] = $course->name;
        }
        $model = new Lecture();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'courses' => $courseList,
        ]);
    }

    /**
     * Updates an existing Lecture model.
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
                    'course' => Course::find()->where(['id' => $model->course_id])->one()
        ]);
    }

    /**
     * Deletes an existing Lecture model.
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
     * Finds the Lecture model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Lecture the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Lecture::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
