<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Visit;

/**
 * VisitSearch represents the model behind the search form of `app\models\Visit`.
 */
class VisitSearch extends Visit {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'student_id', 'lesson_id', 'rate'], 'integer'],
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
        

        // add conditions that should always apply here

        $userIdentity = User::getIdentityUser();
        if ($userIdentity->type == User::getTeacher()) {
            $courses = Course::find()->where(['teacher_id' => $userIdentity->id])->all();

            $listStudents = [];
            foreach ($courses as $course) {
                $students = $course->courseStudents;
                foreach ($students as $student) {
                    $listStudents[] = $student->student->id;
                }
            }
            
            $query = Visit::find()->where(['student_id' => $listStudents]);
        }
        
        if($userIdentity->type == User::getAdmin()){
            $query = Visit::find();
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
            'student_id' => $this->student_id,
            'lesson_id' => $this->lesson_id,
            'rate' => $this->rate,
        ]);

        return $dataProvider;
    }

}
