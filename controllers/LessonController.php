<?php

namespace app\controllers;

use app\models\Lesson;
use app\models\LessonSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\filters\AccessControl;
use app\models\User;
use app\models\Lecture;
use app\models\Course;
use yii\data\ActiveDataProvider;
use app\models\Place;

/**
 * LessonController implements the CRUD actions for Lesson model.
 */
class LessonController extends Controller {

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
                                    return $user->type == User::getStudent();
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
                                    return $user->type == User::getAdmin();
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
     * Lists all Lesson models.
     *
     * @return string
     */
    public function actionIndex() {
        $searchModel = new LessonSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        if(!$dataProvider){
            return $this->goHome();
        }
        $dataProviderCourse = new ActiveDataProvider([
            'query' => Course::find(),
            
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProviderCourse' => $dataProviderCourse
        ]);
    }

    /**
     * Displays a single Lesson model.
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
     * Creates a new Lesson model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($courseId) {
        $model = new Lesson();
        $lectures = Lecture::find()->where(['course_id' => $courseId])->all();
        $lectureList = [];
        foreach ($lectures as $lecture) {
            $lectureList[$lecture->id] = $lecture->name;
        }

        $places = Place::find()->all();
        $placeList = [];
        foreach ($places as $places) {
            $placeList[$places->id] = $places->address;
        }
        
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'lecture' => $lectureList,
            'place' => $placeList,
        ]);
    }

    /**
     * Updates an existing Lesson model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        //$lectures = Lecture::find()->where(['course_id' => $courseId])->all();
//        $lectureList = [];
//        foreach ($lectures as $lecture) {
//            $lectureList[$lecture->id] = $lecture->name;
//        }

        $places = Place::find()->all();
        $placeList = [];
        foreach ($places as $places) {
            $placeList[$places->id] = $places->address;
        }
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'lecture' => $model->lecture,
            'place' => $placeList,
        ]);
    }

    /**
     * Deletes an existing Lesson model.
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
     * Finds the Lesson model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Lesson the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Lesson::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
