<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Department;
use app\models\SubmittionDeadLine;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectProposalYear */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-proposal-year-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
    $year=[];
    $deadline=SubmittionDeadLine::find()->where('dead_line>="'.date('Y-m-d').'"')->all();
    if (!empty($deadline)) {
        foreach($deadline as $deadline)
        {
            $year[$deadline->current_year]=$deadline->current_year;
        }
    }
    echo $form->field($model, 'submit_year')->dropDownList($year);
    ?>
    <?= $form->field($model, 'department_id')->dropDownList(ArrayHelper::map(Department::find()->all(),'id','department_name'),['prompt'=>'']) ?>
    
    <div id="list_pt">
        <?php
            echo Yii::$app->controller->renderPartial('_list_form_project');
        ?>
   </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', '​ບັນ​ທືກ'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
