<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Department;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'department_id')->dropDownList(ArrayHelper::map(Department::find()->where(['id'=>Yii::$app->user->identity->department_id])->all(),'id','department_name')) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
    
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'ບັນ​ທືກ'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
