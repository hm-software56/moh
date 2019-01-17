<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Department;
use app\models\SubmittionDeadLine;
use kartik\select2\Select2;
use app\models\ProjectProposalYear;
use app\models\ProjectProposal;
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
    <div>
            <label><?=Yii::t('app','ສະ​ຖາ​ນະ')?></label>
            <select name="status" id="code_old_project" class="form-control">
            <option ></option>
                <option value="​ສືບ​ຕໍ່">ສືບ​ຕໍ່</option>
                <option value="ໃໝ່">ໃໝ່</option>
            </select>
    </div>
    <br/>
    <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-eye-open"></span> '.Yii::t('app', 'ເບີ່ງ'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
if (!empty($model->department_id)) {
    ?>
    <div class="col-md-12" align="right" style="padding-top:25px">
        <?= Html::a('<span class="glyphicon glyphicon-print"></span> '.Yii::t('app', 'Excel'),['excel'], ['class' => 'btn btn-danger']) ?>
    </div>
<div id="textBox">
<table class="table tab-content">
    <tr>
    <td colspan="5" style="background-color:#0acae5"><b><?=Yii::t('app', 'ບົດ​ສະ​ເໜີ​ໂຄງ​ການ​ຂອງ​ປີ:').$model->submit_year ?></b></td>
    <td align="right"><b>
        <?php
        $total_by_year=ProjectProposal::find()->joinWith('projectProposalYear')
        ->where(['submit_year'=>Yii::$app->session['syear']])
        ->where(['in', 'department_id', $model->department_id])
        ->andWhere(['in','code_old_project',Yii::$app->session['r_status']])
        ->sum('amount');
        if ($total_by_year>0 && Yii::$app->user->identity->type=="Admin") {
            echo number_format($total_by_year, 2);
        }
        ?>
        </b>
    </td>
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
            <td colspan="5" style="background-color:#eff5f5"><b><?=$department->department_name?></b></td>
            <td align="right"><b>
            <?php
                $total_by_department=ProjectProposal::find()->joinWith('projectProposalYear')
                ->where(['department_id'=>$department->id])
                ->andWhere(['submit_year'=>Yii::$app->session['syear']])
                ->andWhere(['in','code_old_project',Yii::$app->session['r_status']])
                ->sum('amount');
                if ($total_by_department>0) {
                    echo number_format($total_by_department, 2);
                }
            ?></b>
            </td>
        </tr>
        <?php
            if (!empty($proposalyear)) {
                    $proposals=ProjectProposal::find()->where(['project_proposal_year_id'=>$proposalyear->id])->andWhere(['in','code_old_project',Yii::$app->session['r_status']])->all();
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
        <td align="right"><?=number_format($proposal->amount, 2)?></td>
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
