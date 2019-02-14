<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EmployeeLevel */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Employee Levels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-level-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'year',
            'phd_male_in',
            'phd_female_in',
            'phd_male_out',
            'phd_female_out',
            'master_male_in',
            'master_female_in',
            'master_male_out',
            'master_female_out',
            'bachelor_degree_male_in',
            'bachelor_degree_female_in',
            'bachelor_degree_male_out',
            'bachelor_degree_female_out',
            'bachelor_male_in',
            'bachelor_female_in',
            'bachelor_male_out',
            'bachelor_female_out',
            'middle_diploma_male_in',
            'middle_diploma_female_in',
            'middle_diploma_male_out',
            'middle_diploma_female_out',
            'lower_diploma_male_in',
            'lower_diploma_female_in',
            'lower_diploma_male_out',
            'lower_diploma_female_out',
            'ministry_id',
        ],
    ]) ?>

</div>
