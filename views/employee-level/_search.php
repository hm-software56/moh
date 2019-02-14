<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EmployeeLevelSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-level-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'year') ?>

    <?= $form->field($model, 'phd_male_in') ?>

    <?= $form->field($model, 'phd_female_in') ?>

    <?= $form->field($model, 'phd_male_out') ?>

    <?php // echo $form->field($model, 'phd_female_out') ?>

    <?php // echo $form->field($model, 'master_male_in') ?>

    <?php // echo $form->field($model, 'master_female_in') ?>

    <?php // echo $form->field($model, 'master_male_out') ?>

    <?php // echo $form->field($model, 'master_female_out') ?>

    <?php // echo $form->field($model, 'bachelor_degree_male_in') ?>

    <?php // echo $form->field($model, 'bachelor_degree_female_in') ?>

    <?php // echo $form->field($model, 'bachelor_degree_male_out') ?>

    <?php // echo $form->field($model, 'bachelor_degree_female_out') ?>

    <?php // echo $form->field($model, 'bachelor_male_in') ?>

    <?php // echo $form->field($model, 'bachelor_female_in') ?>

    <?php // echo $form->field($model, 'bachelor_male_out') ?>

    <?php // echo $form->field($model, 'bachelor_female_out') ?>

    <?php // echo $form->field($model, 'middle_diploma_male_in') ?>

    <?php // echo $form->field($model, 'middle_diploma_female_in') ?>

    <?php // echo $form->field($model, 'middle_diploma_male_out') ?>

    <?php // echo $form->field($model, 'middle_diploma_female_out') ?>

    <?php // echo $form->field($model, 'lower_diploma_male_in') ?>

    <?php // echo $form->field($model, 'lower_diploma_female_in') ?>

    <?php // echo $form->field($model, 'lower_diploma_male_out') ?>

    <?php // echo $form->field($model, 'lower_diploma_female_out') ?>

    <?php // echo $form->field($model, 'ministry_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
