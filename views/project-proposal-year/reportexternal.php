<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Department;
use app\models\SubmittionDeadLine;
use kartik\select2\Select2;
use app\models\ProjectProposalYear;
use app\models\ProjectProposal;
$script = <<< JS
    $(function(){
    $('#save').click(function () {
        var mysave = $('#textBox').html();
        $('#hiddeninput').val(mysave);
    });
});
JS;
$this->registerJs($script);
?>

<div class="project-proposal-year-form">

    <?php $form = ActiveForm::begin([]); ?>
    <?php
    $year=[];
    $deadline=SubmittionDeadLine::find()->all();
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
    echo $form->field($model, 'department_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map($department,'id','department_name'),
        'language' => 'en',
        'options' => ['multiple' => true, 'placeholder' =>Yii::t('app','ເລືອກ​ກົມ')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-eye-open"></span> '.Yii::t('app', 'ເບີ່ງ'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
if (!empty($model->department_id)) {
    ?>
<div class="col-md-12" align="right" style="padding-top:25px">
    <?php $form = ActiveForm::begin(['action'=>['download']]); ?>
    <input id="hiddeninput" name="text" type="hidden"/>
    <button class="btn btn-danger" type="submit" id="save"  formtarget="_blank"><span class="glyphicon glyphicon-print"></span> <?=Yii::t('app', 'Excel')?></button>
    <?php ActiveForm::end(); ?>
</div>
<div id="textBox">
<table class="table tab-content">
    <tr>
    <td colspan="3"><b><?=Yii::t('app', 'ບົດ​ສະ​ເໜີ​ໂຄງ​ການ​ຂອງ​ປີ:').$model->submit_year ?></b></td>
    </tr>
    <tr>
        <th style="background:#a1c4c4"><?=Yii::t('app', 'ລ/ດ')?></th>
        <th style="background:#a1c4c4"><?=Yii::t('app', 'ຊື່​​ໂຄງ​ການ')?></th>
        <th style="background:#a1c4c4"><?=Yii::t('app', 'ສະ​ຖາ​ນະ')?></th>
        <th style="background:#a1c4c4"><?=Yii::t('app', '​ປີ​ເລີ່ມ')?></th>
        <th style="background:#a1c4c4"><?=Yii::t('app', '​ປີ​ສີ້ນ​ສຸດ')?></th>
        <th style="background:#a1c4c4"><?=Yii::t('app', '​ຈຳ​ນວນ​ເງີນ/​ລ້ານ​ກີບ')?></th>
    </tr>
    <?php
    if (!empty($model->department_id)) {
        $departments =Department::find()->where(['in', 'id', $model->department_id])->all();
        foreach ($departments as $department) {
            $proposalyear =ProjectProposalYear::find()->where(['department_id'=>$department->id])->andWhere(['submit_year'=>$model->submit_year])->one(); ?>
        <tr>
            <td colspan="6" style="background-color:#eff5f5"><b><?=$department->department_name?></b></td>
        </tr>
        <?php
            if (!empty($proposalyear)) {
                $proposals=ProjectProposal::find()->where(['project_proposal_year_id'=>$proposalyear->id])->all();
                if (!empty($proposals)) {
                    $i=0;
                    foreach ($proposals as $proposal) {
                        $i++; ?>
    <tr>
        <td><?=$i?></td>
        <td><?=$proposal->project_name?></td>
        <td><?=$proposal->code_old_project?></td>
        <td><?=$proposal->start_year?></td>
        <td><?=$proposal->end_year?></td>
        <td><?=number_format($proposal->amount, 2)?></td>
    </tr>
    <?php
                    }
                }
            } else {
                ?>
    <tr>
            <td colspan="5"><?=Yii::t('app', '​ຍັງບໍ່​ມີ​ບົດ​ສະ​ເໜີ​ໂຄງ​ການ')?><td>
    </tr>
    <?php
            }
        }
    } ?>
</table>
</div>
<?php
}
?>
