<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CourseStudent;
use app\models\Course;
use app\models\User;

/**
 * CourseStudentSearch represents the model behind the search form of `app\models\CourseStudent`.
 */
class CourseStudentSearch extends CourseStudent {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'course_id', 'student_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $userIdentity = User::getIdentityUser();
        if (isset($userIdentity->type) && $userIdentity->type == User::getAdmin()) {   // если администратор
            $query = CourseStudent::find();
        }

        if (isset($userIdentity->type) && $userIdentity->type == User::getTeacher()) {   // если администратор
            $courses = Course::find()->where(['teacher_id' => $userIdentity->id])->all();
            $courseId = [];
            foreach ($courses as $course){
                $courseId[] = $course->id;
            }
            $query = CourseStudent::find()->where(['course_id'=>$courseId]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'course_id' => $this->course_id,
            'student_id' => $this->student_id,
        ]);

        return $dataProvider;
    }

}
