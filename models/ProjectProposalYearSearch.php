<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProjectProposalYear;

/**
 * ProjectProposalYearSearch represents the model behind the search form of `app\models\ProjectProposalYear`.
 */
class ProjectProposalYearSearch extends ProjectProposalYear
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'submit_year', 'department_id'], 'integer'],
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
        $query = ProjectProposalYear::find();

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
            'submit_year' => $this->submit_year,
            
        ]);
        if(Yii::$app->user->id && Yii::$app->user->identity->type!="Admin")
        {
            $query->andFilterWhere(
                [
                    'department_id' =>Yii::$app->user->identity->department_id,
                ]
            );
        }

        return $dataProvider;
    }
}
