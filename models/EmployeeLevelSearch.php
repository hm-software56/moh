<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EmployeeLevel;

/**
 * EmployeeLevelSearch represents the model behind the search form of `app\models\EmployeeLevel`.
 */
class EmployeeLevelSearch extends EmployeeLevel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'year', 'phd_male_in', 'phd_female_in', 'phd_male_out', 'phd_female_out', 'master_male_in', 'master_female_in', 'master_male_out', 'master_female_out', 'bachelor_degree_male_in', 'bachelor_degree_female_in', 'bachelor_degree_male_out', 'bachelor_degree_female_out', 'bachelor_male_in', 'bachelor_female_in', 'bachelor_male_out', 'bachelor_female_out', 'middle_diploma_male_in', 'middle_diploma_female_in', 'middle_diploma_male_out', 'middle_diploma_female_out', 'lower_diploma_male_in', 'lower_diploma_female_in', 'lower_diploma_male_out', 'lower_diploma_female_out', 'ministry_id'], 'integer'],
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
        $query = EmployeeLevel::find();

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
            'year' => $this->year,
            'phd_male_in' => $this->phd_male_in,
            'phd_female_in' => $this->phd_female_in,
            'phd_male_out' => $this->phd_male_out,
            'phd_female_out' => $this->phd_female_out,
            'master_male_in' => $this->master_male_in,
            'master_female_in' => $this->master_female_in,
            'master_male_out' => $this->master_male_out,
            'master_female_out' => $this->master_female_out,
            'bachelor_degree_male_in' => $this->bachelor_degree_male_in,
            'bachelor_degree_female_in' => $this->bachelor_degree_female_in,
            'bachelor_degree_male_out' => $this->bachelor_degree_male_out,
            'bachelor_degree_female_out' => $this->bachelor_degree_female_out,
            'bachelor_male_in' => $this->bachelor_male_in,
            'bachelor_female_in' => $this->bachelor_female_in,
            'bachelor_male_out' => $this->bachelor_male_out,
            'bachelor_female_out' => $this->bachelor_female_out,
            'middle_diploma_male_in' => $this->middle_diploma_male_in,
            'middle_diploma_female_in' => $this->middle_diploma_female_in,
            'middle_diploma_male_out' => $this->middle_diploma_male_out,
            'middle_diploma_female_out' => $this->middle_diploma_female_out,
            'lower_diploma_male_in' => $this->lower_diploma_male_in,
            'lower_diploma_female_in' => $this->lower_diploma_female_in,
            'lower_diploma_male_out' => $this->lower_diploma_male_out,
            'lower_diploma_female_out' => $this->lower_diploma_female_out,
            'ministry_id' => $this->ministry_id,
        ]);

        return $dataProvider;
    }
}
