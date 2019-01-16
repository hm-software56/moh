<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Projects');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Project'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'project_name',
            'sector_code',
            'project_code',
            'budget_code',
            //'project_start_year',
            //'project_end_year',
            //'payment_start_year',
            //'payment_end_year',
            //'project_type_id',
            //'govt_budget',
            //'approved_govt_budget',
            //'oda_budget',
            //'approved',
            //'is_oda',
            //'evaluation_at_plan',
            //'final_evaluation',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
