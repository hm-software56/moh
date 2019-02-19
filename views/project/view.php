<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\ProjectStatus;
use app\models\ProjectPayment;
use app\models\Loan;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ໂຄງ​ການ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$loan=Loan::find()->where(['project_id'=>$model->id])->one();
?>
<div class="project-view">
    <p align="right">
        <?= Html::a("<il class='glyphicon glyphicon-edit'></il> ".Yii::t('app', '​ແກ້​ໄຂ'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a("<il class='glyphicon glyphicon-remove'></il> ".Yii::t('app', 'ລື​ບ​ອອກ'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <table class="table table-bordered">
        <tr>
            <th><?=$model->getAttributeLabel('project_type_id')?></th>
            <td colspan="8"><?=$model->projectType->project_type?></td>
        </tr>
        <tr>
            <th><?=$model->getAttributeLabel('project_name')?></th>
            <td colspan="8"><?=$model->project_name?></td>
        </tr>
        <tr>
            <th><?=$model->getAttributeLabel('sector_code')?></th>
            <td><?=$model->sector_code?></td>
            <th><?=$model->getAttributeLabel('project_code')?></th>
            <td><?=$model->project_code?></td>
            <th><?=$model->getAttributeLabel('budget_code')?></th>
            <td colspan="3"><?=$model->budget_code?></td>
        </tr>
        <tr>
            <th><?=$model->getAttributeLabel('project_start_year')?></th>
            <td><?=$model->project_start_year?></td>
            <th><?=$model->getAttributeLabel('project_end_year')?></th>
            <td><?=$model->project_end_year?></td>
            <th><?=$model->getAttributeLabel('payment_start_year')?></th>
            <td><?=$model->payment_start_year?></td>
            <th><?=$model->getAttributeLabel('payment_end_year')?></th>
            <td><?=$model->payment_end_year?></td>
        </tr>
        <tr>
            <th><?=$model->getAttributeLabel('govt_budget')?></th>
            <td><?=$model->govt_budget?></td>
            <th><?=$model->getAttributeLabel('approved_govt_budget')?></th>
            <td><?=$model->approved_govt_budget?></td>
            <th><?=$model->getAttributeLabel('approved')?></th>
            <td colspan='3'><?php 
                if($model->approved==1)
                {
                    echo "ອະ​ນຸ​ມັດ​ແລ້ວ";
                }
                if($model->approved==0)
                {
                    echo "ບໍ່ອະ​ນຸ​ມັດ​";
                }
            ?></td>
        </tr>
        <tr>
            <th><?=$model->getAttributeLabel('is_oda')?></th>
            <td><?php
            if (!empty($model->is_oda)) {
                echo "Yes";
            }else{
                echo "No";
            }
            ?></td>
            
            <th><?=$model->getAttributeLabel('oda_budget')?></th>
            <td><?=$model->oda_budget?></td>
            <th><?=$model->getAttributeLabel('evaluation_at_plan')?></th>
            <td><?=$model->evaluation_at_plan?></td>
            <th><?=$model->getAttributeLabel('final_evaluation')?></th>
            <td><?=$model->final_evaluation?></td>
        </tr>
        <?php
        if (!empty($loan)) {
            ?>
        <tr>
            <th><?=$loan->getAttributeLabel('amount')?></th>
            <td><?=$loan->amount?></td>
            <th><?=$loan->getAttributeLabel('interest_rate')?></th>
            <td><?=$loan->interest_rate?></td>
        </tr>
        <?php
        }
        ?>
    </table>
    <div class="row">
        <div class="col-md-12">
            <div class="contacts table-responsive">
                <label>
                    <?=Yii::t('app', 'ລາຍ​ການແຜ່ນ​ແລະ​ການ​ຊຳ​ລະ (​ຫົວ​ໜ່ວຍ: ລ້ານ​ກີບ)')?></label>
                <table class="table table-bordered table-dark tab-content">
                    <tr style="background:#eff5f5">
                        <th><?=Yii::t('app', 'ປີ')?></th>
                        <th><?=Yii::t('app', '​ສະ​ຖາ​ນະ')?></th>
                        <th><?=Yii::t('app', 'ຈໍານວນ​ເງີນສະເຫນີ')?></th>
                        <th><?=Yii::t('app', 'ຈໍານວນເງິນອະນຸມັດ')?></th>
                        <th><?=Yii::t('app', 'ມູນ​ຄ່າ​​ຊຳລະ​ 6 ຕົ້ນ​ປີ')?></th>
                        <th><?=Yii::t('app', 'ມູນ​ຄ່າ​ຊຳລະ​ 6 ທ້າຍ​​ປີ')?></th>
                    </tr>
                    <?php
                        if(!empty($projectprogress))
                        {
                            foreach ($projectprogress as $pg) {
                            ?>
                    <tr>
                        <td><?=$pg->project_year?></td>
                        <td><?=ProjectStatus::find()->where(['id'=>$pg->project_status_id])->one()->project_status?>
                        </td>
                        <td><?=$pg->proposal_amount?></td>
                        <td><?=$pg->aproved_amount?></td>
                        <td>
                            <?php
                                 $model=ProjectPayment::find()->where(['project_progression_id'=>$pg->id,'payment_type'=>'first_six_months'])->one();
                                if(!empty($model) && $model->amount>0)
                                {
                                 echo $model->amount;
                                }else{
                                    echo "0.00";
                                }
                                ?>
                        </td>
                        <td>
                            <?php
                                $model=ProjectPayment::find()->where(['project_progression_id'=>$pg->id,'payment_type'=>'full_year'])->one();
                                if(!empty($model) && $model->amount>0)
                                {
                                 echo $model->amount;
                                }else{
                                    echo "0.00";
                                }
                                ?>
                        </td>
                    </tr>
                    <?php
                            }
                            ?>

                    <?php
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>