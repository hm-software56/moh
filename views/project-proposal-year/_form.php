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

    <?php $form = ActiveForm::begin([]); ?>
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
    <?php
    if(Yii::$app->user->identity->type=="User")
    {
        $department=Department::find()->where(['id'=>Yii::$app->user->identity->department_id])->all();
    }else{
        $department=Department::find()->all();
    }
   // $department=Department::find()->all();
    echo $form->field($model, 'department_id')->dropDownList(ArrayHelper::map($department,'id','department_name'),['prompt'=>'']) ?>
    
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
