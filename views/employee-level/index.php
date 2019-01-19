<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmployeeLevelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Employee Levels');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-level-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Employee Level'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'year',
            'phd_male_in',
            'phd_female_in',
            'phd_male_out',
            //'phd_female_out',
            //'master_male_in',
            //'master_female_in',
            //'master_male_out',
            //'master_female_out',
            //'bachelor_degree_male_in',
            //'bachelor_degree_female_in',
            //'bachelor_degree_male_out',
            //'bachelor_degree_female_out',
            //'bachelor_male_in',
            //'bachelor_female_in',
            //'bachelor_male_out',
            //'bachelor_female_out',
            //'middle_diploma_male_in',
            //'middle_diploma_female_in',
            //'middle_diploma_male_out',
            //'middle_diploma_female_out',
            //'lower_diploma_male_in',
            //'lower_diploma_female_in',
            //'lower_diploma_male_out',
            //'lower_diploma_female_out',
            //'ministry_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
