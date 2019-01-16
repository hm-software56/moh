<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Project;

/**
 * ProjectSearch represents the model behind the search form of `app\models\Project`.
 */
class ProjectSearch extends Project
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'project_type_id', 'approved', 'is_oda'], 'integer'],
            [['project_name', 'sector_code', 'project_code', 'budget_code', 'project_start_year', 'project_end_year', 'payment_start_year', 'payment_end_year', 'evaluation_at_plan', 'final_evaluation'], 'safe'],
            [['govt_budget', 'approved_govt_budget', 'oda_budget'], 'number'],
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
        $query = Project::find();

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
            'project_start_year' => $this->project_start_year,
            'project_end_year' => $this->project_end_year,
            'payment_start_year' => $this->payment_start_year,
            'payment_end_year' => $this->payment_end_year,
            'project_type_id' => $this->project_type_id,
            'govt_budget' => $this->govt_budget,
            'approved_govt_budget' => $this->approved_govt_budget,
            'oda_budget' => $this->oda_budget,
            'approved' => $this->approved,
            'is_oda' => $this->is_oda,
        ]);

        $query->andFilterWhere(['like', 'project_name', $this->project_name])
            ->andFilterWhere(['like', 'sector_code', $this->sector_code])
            ->andFilterWhere(['like', 'project_code', $this->project_code])
            ->andFilterWhere(['like', 'budget_code', $this->budget_code])
            ->andFilterWhere(['like', 'evaluation_at_plan', $this->evaluation_at_plan])
            ->andFilterWhere(['like', 'final_evaluation', $this->final_evaluation]);

        return $dataProvider;
    }
}
