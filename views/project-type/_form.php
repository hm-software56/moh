<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_type')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'ບັນ​ທືກ'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
