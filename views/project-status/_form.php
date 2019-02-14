<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectStatus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-status-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', '​ບັນ​ທຶກ'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
