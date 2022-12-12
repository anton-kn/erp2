<?php

namespace app\controllers;

use app\models\CourseStudent;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Course;
use app\models\User;
use Yii;
use yii\filters\AccessControl;

/**
 * CourseStudentController implements the CRUD actions for CourseStudent model.
 */
class CourseStudentController extends Controller {

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
                                'actions' => ['logout', 'index', 'create', 'update', 'view', 'delete'],
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
     * Lists all CourseStudent models.
     *
     * @return string
     */
    public function actionIndex($id = null) {
        $userIdentity = User::getIdentityUser();

        $courseId = null;
        if (isset($userIdentity->is_admin)) {         // если администратор
            if ($id == null) {
                // находим первый курс
                $courseId = Course::find()->min('id');
            } else {
                $courseId = $id;
            }

            $courses = Course::find()->all();
        }

        if (isset($userIdentity->type) && $userIdentity->type == User::getTeacher()) {     // если преподаватель
            if ($id == null) {
                // находим первый курс преподавателя
                $courseId = Course::find()->where(['teacher_id' => $userIdentity->id])->min('id');
            } else {
                $courseId = $id;
            }
            $courses = Course::find()->where(['teacher_id' => $userIdentity->id])->all();
        }
        $course = Course::findOne($courseId);
//        echo '<pre>';
//        var_dump($course->id);
//        echo '</pre>';
//        exit();

        $dataProvider = new ActiveDataProvider([
            'query' => CourseStudent::find()->where(['course_id' => $courseId])
                /*
                  'pagination' => [
                  'pageSize' => 50
                  ],
                  'sort' => [
                  'defaultOrder' => [
                  'id' => SORT_DESC,
                  ]
                  ],
                 */
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'model' => $course,
                    'courses' => $courses,
        ]);
    }

    /**
     * Displays a single CourseStudent model.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CourseStudent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate() {
        $model = new CourseStudent();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
                    'model' => $model,
                    'user' => User::getFullName(true),
                    'course' => Course::getCourses(),
        ]);
    }

    /**
     * Updates an existing CourseStudent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
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
                    'user' => User::getFullName(true),
                    'course' => Course::getCourses(),
        ]);
    }

    /**
     * Deletes an existing CourseStudent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CourseStudent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return CourseStudent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = CourseStudent::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
