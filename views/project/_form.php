<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\ProjectType;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>
<script>
function isOda() {
    var checkBox = document.getElementById("project-is_oda");
    var text = document.getElementById("show_budge_oda");
    if (checkBox.checked == true) {
        text.style.display = "block";
    } else {
        text.style.display = "none";
    }
}

function loan() {
    var checkBox = document.getElementById("loan-project_id");
    var text = document.getElementById("show_budge_loan");
    if (checkBox.checked == true) {
        text.style.display = "block";
    } else {
        text.style.display = "none";
    }
}
</script>


<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'project_type_id')->dropDownList(ArrayHelper::map(ProjectType::find()->all(), 'id', 'project_type'), ['prompt'=>'']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'project_name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'sector_code')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'project_code')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'budget_code')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'project_start_year')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'project_end_year')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'payment_start_year')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'payment_end_year')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'govt_budget',['enableClientValidation' => false])->textInput(['class'=>'form-control money_format']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'approved_govt_budget',['enableClientValidation' => false])->textInput(['class'=>'form-control money_format']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'approved')->dropDownList([1=>Yii::t('app', 'ອະ​ນຸ​ມັດ'),0=>Yii::t('app', 'ບໍ່ອະ​ນຸ​ມັດ')], ['prompt'=>'']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'is_oda')->checkBox(['onclick'=>"isOda()"]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($loan, 'project_id')->checkBox(['onclick'=>"loan()",'label'=>'ເປັນເງິນກູ້ຢືມ']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6" id="show_budge_oda" style="display:<?=($model->is_oda==1)?"block":"none"?>">
            <?= $form->field($model, 'oda_budget',['enableClientValidation' => false])->textInput(['class'=>'form-control money_format']) ?>
        </div>
        <span id="show_budge_loan" style="display:<?=!empty($loan->project_id)?"block":"none"?>">
            <div class="col-md-3">
                <?= $form->field($loan, 'amount',['enableClientValidation' => false])->textInput(['class'=>'form-control money_format']) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($loan, 'interest_rate',['enableClientValidation' => false])->textInput(['class'=>'form-control money_format']) ?>
            </div>
        </span>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'evaluation_at_plan')->dropDownList([ 'A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', 'F' => 'F', ], ['prompt' => '']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'final_evaluation')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div id="list_pt">
        <?php
            echo Yii::$app->controller->renderPartial('list_project_progess.php');
        ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-floppy-disk"></span> '.Yii::t('app', 'ບັນ​ທືກ'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>