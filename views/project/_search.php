<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'project_name') ?>

    <?= $form->field($model, 'sector_code') ?>

    <?= $form->field($model, 'project_code') ?>

    <?= $form->field($model, 'budget_code') ?>

    <?php // echo $form->field($model, 'project_start_year') ?>

    <?php // echo $form->field($model, 'project_end_year') ?>

    <?php // echo $form->field($model, 'payment_start_year') ?>

    <?php // echo $form->field($model, 'payment_end_year') ?>

    <?php // echo $form->field($model, 'project_type_id') ?>

    <?php // echo $form->field($model, 'govt_budget') ?>

    <?php // echo $form->field($model, 'approved_govt_budget') ?>

    <?php // echo $form->field($model, 'oda_budget') ?>

    <?php // echo $form->field($model, 'approved') ?>

    <?php // echo $form->field($model, 'is_oda') ?>

    <?php // echo $form->field($model, 'evaluation_at_plan') ?>

    <?php // echo $form->field($model, 'final_evaluation') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
