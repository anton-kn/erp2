<?php

namespace app\controllers;

use app\models\CourseStudent;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Course;
use app\models\User;

/**
 * CourseStudentController implements the CRUD actions for CourseStudent model.
 */
class CourseStudentController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
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
    public function actionIndex()
    {
        //$courses = Course::getCourses();
        $courses = Course::findOne(1);
        
        $users = $courses->courseStudents;
        echo "<pre>";
        var_dump($users[0]->student_id);
        echo "</pre>";
        exit();
        
        $students = CourseStudent::find()->all();
        
        $dataProvider = new ActiveDataProvider([
           'query' => CourseStudent::find(),
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
            'courses' => $courses,
            'students' => $students
        ]);
    }

    /**
     * Displays a single CourseStudent model.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CourseStudent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new CourseStudent();
        $courses = Course::getCourses();
        $students = User::getFullName(true);
        if ($this->request->isPost) {
            $courseId = $this->request->post()['CourseStudent']["course_id"];
            $students = $this->request->post()['CourseStudent']["student_id"];
            foreach ($students as $student){
                $model = new CourseStudent();
                $model->course_id = $courseId;
                $model->student_id = $student;
                $model->save();
            }
            return $this->redirect(['index']);
              
//            if ($model->load($this->request->post()) && $model->save()) {
//                return $this->redirect(['view', 'id' => $model->id]);
//            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => new CourseStudent(),
            'courses' => $courses,
            'students' => $students,
        ]);
    }

    /**
     * Updates an existing CourseStudent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CourseStudent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
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
    protected function findModel($id)
    {
        if (($model = CourseStudent::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
