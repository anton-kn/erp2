<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Lesson;
use app\models\Lecture;
use app\models\User;

/**
 * LessonSearch represents the model behind the search form of `app\models\Lesson`.
 */
class LessonSearch extends Lesson {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'lecture_id', 'place_id'], 'integer'],
            [['date', 'time_start', 'time_end'], 'safe'],
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
//        $query = Lesson::find();
        $userIdentity = User::getIdentityUser();
        if ($userIdentity->type == User::getAdmin()) {
            $query = Lesson::find();
        }
        if ($userIdentity->type == User::getTeacher()) {
            $courses = Course::find()->where(['teacher_id' => $userIdentity->id])->all();
            $listLesson = [];
            foreach ($courses as $course){
                foreach ($course->lectures as $lecture){
                    $listLesson[$lecture->id] = $lecture->lesson;
                }
            }
            $query = Lesson::find()->where(['id' => $listLesson]);
        }
        
        if ($userIdentity->type == User::getStudent()) {
            $course = CourseStudent::find()->where(['student_id' => $userIdentity->id])->one();
            $listLesson = [];
            foreach ($course->lectures as $lecture){
                $listLesson[$lecture->id] = $lecture->lesson;
            }
            $query = Lesson::find()->where(['id' => $listLesson]);
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
            'lecture_id' => $this->lecture_id,
            'date' => $this->date,
            'time_start' => $this->time_start,
            'time_end' => $this->time_end,
            'place_id' => $this->place_id,
        ]);

        return $dataProvider;
    }

}
