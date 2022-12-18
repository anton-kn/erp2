<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Lecture;
use app\models\User;
use app\models\CourseStudent;

/**
 * LectureSearch represents the model behind the search form of `app\models\Lecture`.
 */
class LectureSearch extends Lecture {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'num', 'course_id'], 'integer'],
            [['name'], 'safe'],
            [['rate'], 'number'],
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
        
        if (isset($params['courseId'])) {
            $query = Lecture::find()->where(['course_id' => $params['courseId']]);
        } else {
            $userIdentity = User::getIdentityUser();
            if ($userIdentity->type == User::getTeacher()) { 
                $courses = Course::find()->where(['teacher_id' => $userIdentity->id])->all();
                $courseId = [];
                foreach ($courses as $course){
                    $courseId[] = $course->id;
                }
                $query = Lecture::find()->where(['course_id' => $courseId]);
            }
            
            if ($userIdentity->type == User::getStudent()) {  
                $сourse = CourseStudent::find()->where(['student_id' => $userIdentity->id])->one();
                $query = Lecture::find()->where(['course_id' => $сourse->course_id]);
            }
        }


        // add conditions that should always apply here

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
            'num' => $this->num,
            'course_id' => $this->course_id,
            'rate' => $this->rate,
        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name]);

        return $dataProvider;
    }

}
