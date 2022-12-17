<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Course;
use app\models\User;

/**
 * CourseSearch represents the model behind the search form of `app\models\Course`.
 */
class CourseSearch extends Course
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'teacher_id'], 'integer'],
            [['name', 'date_start', 'date_end'], 'safe'],
            [['rate_med'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $identityUser = User::getIdentityUser();
        if (isset($identityUser->is_admin)) {
            $query = Course::find();
        }
        if (isset($identityUser) && $identityUser->type == User::getTeacher()) {
            $query = Course::find()->where(['teacher_id' => $identityUser->id]);
        }
        if (isset($identityUser) && $identityUser->type == User::getStudent()) {
            $courseStudent = CourseStudent::find()->where(['student_id' => $identityUser->id])->one();
            $query = Course::find()->where(['id' => $courseStudent->course_id]);
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
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'status' => $this->status,
            'teacher_id' => $this->teacher_id,
            'rate_med' => $this->rate_med,
        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name]);

        return $dataProvider;
    }
}
