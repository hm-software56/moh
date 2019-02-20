<?php
use app\models\GroupProjectType;
use app\models\Project;
use app\models\ProjectPayment;
use app\models\ProjectProgression;
use app\models\ProjectStatus;
$year=2019;
?>
<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th rowspan="2">ລ/ດ</th>
            <th colspan="3">​ເລກ​ລະ​ຫັດ</th>
            <th rowspan="2">​ຊື່​ແລະ​ທີ່​ຕັ້ງ​ຂອງ​ໂຄງ​ການ</th>
            <th rowspan="2">​ຈ/ນ ຄ/ກ</th>
            <th colspan="2">​ໄລ​ຍະ​ໂຄງ​ການ</th>
            <th colspan="3">​ມຸນ​ຄ່າ​ລວ​ມ​ໂຄງ​ການ</th>
            <th colspan="3">​ມູນ​ຄ່າ​ປະ​ຕິ​ບັດ<br />​ວຽກ​ຮອດ​ວັນ​ທີ 30/06/<?=$year-1?></th>
            <th colspan="3">ຮອດ​ວັນ​ທີ 31/12/<?=$year-1?></th>
            <th colspan="3">ແຜນ​ການ​ລົງ​ທີນ​ປີ <?=$year?></th>
            <th rowspan="2">ຜົນ​ການ​ປະ​ເມີນ</th>
            <th rowspan="2">ໝາຍ​ເຫດ</th>
        </tr>
        <tr>
            <td>​ຂະ​ແໜງ</td>
            <td>​ໂຄງ​ການ</td>
            <td>​ສາ​ລະ​ບານ ງົບ​ປະ​ມານ</td>
            <td>​ປະ​ຕິ​ບັດ</td>
            <td>​ຊຳ​ລະ</td>
            <td>​ທືນ ພນ</td>
            <td>​ທືນ ຕ​ປ​ທ</td>
            <td>​ລວມ</td>
            <td>​ທືນ ພນ</td>
            <td>​ທືນ ຕ​ປ​ທ</td>
            <td>ລວມ</td>
            <td>​ທືນ ພນ</td>
            <td>​ທືນ ຕ​ປ​ທ</td>
            <td>ລວມ</td>
            <td>​ທືນ ພນ</td>
            <td>​ທືນ ຕ​ປ​ທ</td>
            <td>ລວມ</td>
        </tr>
        <!---------- ລວມປະເພດໂຄງການລົງທຶນຂອງລັດ ---------------------------------------------------------------->
        <tr>
            <td class="text-center">I</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>
                <?=Yii::t('app','ລວມປະເພດໂຄງການລົງທຶນຂອງລັດ')?></td>
            <td class="text-center">
                <?php
        $countgroupproject=Project::find()
        ->joinWith('projectProgressions')
        ->where(['project_year'=>$year])
        ->andWhere(['not', ['approved_govt_budget' => null]])
        ->count();
        echo $countgroupproject;
        ?>
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>
                <?php
            $sumgroupproject=Project::find()
            ->joinWith('projectProgressions')
            ->where(['project_year'=>$year])
            ->andWhere(['not', ['approved_govt_budget' => null]])
            ->sum('approved_govt_budget');
            if ($sumgroupproject>0) {
                echo number_format($sumgroupproject, 2);
            }else{
                echo "-";
            }
        ?>
            </td>
            <td class="text-right">
                <?php
            $sumoutgroupproject=Project::find()
            ->joinWith('projectProgressions')
            ->where(['project_year'=>$year])
            ->andWhere(['not', ['approved_govt_budget' => null]])
            ->sum('oda_budget');
            if ($sumoutgroupproject>0) {
                echo number_format($sumoutgroupproject, 2);
            }else{
                echo "-";
            }
        ?>
            </td>
            <td>
                <?php
            $sumttatol=$sumgroupproject+$sumoutgroupproject;
            if($sumttatol>0)
            {
                echo number_format($sumttatol,2);
            }else{
                echo "-";
            }
        ?>
            </td>
            <td class="text-right">
                <?php
                $sumtotalgroupproject_6_in=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
               // ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>0])
                ->sum('amount');
                if ($sumtotalgroupproject_6_in>0) {
                    echo number_format($sumtotalgroupproject_6_in, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td class="text-right">
                <?php
                $sumtotalgroupproject_6_out=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
               // ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>1])
                ->sum('amount');
                if ($sumtotalgroupproject_6_out>0) {
                    echo number_format($sumtotalgroupproject_6_out, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td>
                <?php
            $sumtatol_6=$sumtotalgroupproject_6_in+$sumtotalgroupproject_6_out;
            if($sumtatol_6>0)
            {
                echo number_format($sumtatol_6,2);
            }else{
                echo "-";
            }
            ?>
            </td>
            <td>
                <?php
                $sumtotalgroupproject_12_in=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
               // ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
               // ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>0])
                ->sum('amount');
                if ($sumtotalgroupproject_12_in>0) {
                    echo number_format($sumtotalgroupproject_12_in, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td>
                <?php
                $sumtotalgroupproject_12_out=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
               // ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
               // ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>1])
                ->sum('amount');
                if ($sumtotalgroupproject_12_out>0) {
                    echo number_format($sumtotalgroupproject_12_out, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td>
                <?php
            $sumtatol_12=$sumtotalgroupproject_12_in+$sumtotalgroupproject_12_out;
            if($sumtatol_12>0)
            {
                echo number_format($sumtatol_12,2);
            }else{
                echo "-";
            }
            ?>
            </td>
            <td>
                <?php
                $sumptotalrojectplan_in=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
               // ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
                ->sum('aproved_amount');
                if ($sumptotalrojectplan_in>0) {
                    echo number_format($sumptotalrojectplan_in, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td>
                <?php
                $sumptotalrojectplan_out=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
               // ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
                ->sum('aproved_amount_oda');
                if ($sumptotalrojectplan_out>0) {
                    echo number_format($sumptotalrojectplan_out, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td>
                <?php
            $sumptotalrojectplan=$sumptotalrojectplan_in+$sumptotalrojectplan_out;
            if($sumptotalrojectplan>0)
            {
                echo number_format($sumptotalrojectplan,2);
            }else{
                echo "-";
            }
            ?>
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <!------------------ ໂຄງການລົງທຶນຂອງລັດລະດັບຊາດ --------------------------------------------->
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><?=Yii::t('app','ໂຄງການລົງທຶນຂອງລັດລະດັບຊາດ')?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <!-------------- ໂຄງການລົງທຶນຂອງລັດປົກະຕິ ---------------------------------------------------------------->
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><?=Yii::t('app','ໂຄງການລົງທຶນຂອງລັດປົກະຕິ')?></td>
            <td class="text-center">
                <?php
        $countgroupproject=Project::find()
        ->joinWith('projectProgressions')
        ->where(['project_year'=>$year])
        ->andWhere(['not', ['approved_govt_budget' => null]])
        ->count();
        echo $countgroupproject;
        ?>
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>
                <?php
            $sumgroupproject=Project::find()
            ->joinWith('projectProgressions')
            ->where(['project_year'=>$year])
            ->andWhere(['not', ['approved_govt_budget' => null]])
            ->sum('approved_govt_budget');
            if ($sumgroupproject>0) {
                echo number_format($sumgroupproject, 2);
            }else{
                echo "-";
            }
        ?>
            </td>
            <td>
                <?php
            $sumoutgroupproject=Project::find()
            ->joinWith('projectProgressions')
            ->where(['project_year'=>$year])
            ->andWhere(['not', ['approved_govt_budget' => null]])
            ->sum('oda_budget');
            if ($sumoutgroupproject>0) {
                echo number_format($sumoutgroupproject, 2);
            }else{
                echo "-";
            }
        ?>
            </td>
            <td>
                <?php
            $sumttatol=$sumgroupproject+$sumoutgroupproject;
            if($sumttatol>0)
            {
                echo number_format($sumttatol,2);
            }else{
                echo "-";
            }
        ?>
            </td>
            <td class="text-right">
                <?php
                $sumtotalgroupproject_6_in=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
               // ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>0])
                ->sum('amount');
                if ($sumtotalgroupproject_6_in>0) {
                    echo number_format($sumtotalgroupproject_6_in, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td class="text-right">
                <?php
                $sumtotalgroupproject_6_out=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
               // ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>1])
                ->sum('amount');
                if ($sumtotalgroupproject_6_out>0) {
                    echo number_format($sumtotalgroupproject_6_out, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td>
                <?php
            $sumtatol_6=$sumtotalgroupproject_6_in+$sumtotalgroupproject_6_out;
            if($sumtatol_6>0)
            {
                echo number_format($sumtatol_6,2);
            }else{
                echo "-";
            }
            ?>
            </td>
            <td>
                <?php
                $sumtotalgroupproject_12_in=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
               // ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
               // ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>0])
                ->sum('amount');
                if ($sumtotalgroupproject_12_in>0) {
                    echo number_format($sumtotalgroupproject_12_in, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td>
                <?php
                $sumtotalgroupproject_12_out=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
               // ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
               // ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>1])
                ->sum('amount');
                if ($sumtotalgroupproject_12_out>0) {
                    echo number_format($sumtotalgroupproject_12_out, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td>
                <?php
            $sumtatol_12=$sumtotalgroupproject_12_in+$sumtotalgroupproject_12_out;
            if($sumtatol_12>0)
            {
                echo number_format($sumtatol_12,2);
            }else{
                echo "-";
            }
            ?>
            </td>
            <td>
                <?php
                $sumptotalrojectplan_in=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
               // ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
                ->sum('aproved_amount');
                if ($sumptotalrojectplan_in>0) {
                    echo number_format($sumptotalrojectplan_in, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td>
                <?php
                $sumptotalrojectplan_out=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
               // ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
                ->sum('aproved_amount_oda');
                if ($sumptotalrojectplan_out>0) {
                    echo number_format($sumptotalrojectplan_out, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td>
                <?php
            $sumptotalrojectplan=$sumptotalrojectplan_in+$sumptotalrojectplan_out;
            if($sumptotalrojectplan>0)
            {
                echo number_format($sumptotalrojectplan,2);
            }else{
                echo "-";
            }
            ?>
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <!--------- Group project ------------------------------------------------------------------------------>
        <?php
    $groupprojects=GroupProjectType::find()->all();
    foreach ($groupprojects as $groupproject) {
        ?>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td style=" white-space:nowrap !important;"><?=$groupproject->group_name?></td>
            <td class="text-center">
                <?php
            $countgroupproject=Project::find()
            ->joinWith('projectProgressions')
            ->where(['project_year'=>$year])
            ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
            ->count();
            if ($countgroupproject>0) {
                echo $countgroupproject;
            }else{
                echo "-";
            }
        ?>
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td class="text-right">
                <?php
            $sumingroupproject=Project::find()
            ->joinWith('projectProgressions')
            ->where(['project_year'=>$year])
            ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
            ->sum('approved_govt_budget');
            if ($sumingroupproject>0) {
                echo number_format($sumingroupproject, 2);
            }else{
                echo "-";
            }
        ?>
            </td>
            <td class="text-right">
                <?php
            $sumoutgroupproject=Project::find()
            ->joinWith('projectProgressions')
            ->where(['project_year'=>$year])
            ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
            ->sum('oda_budget');
            if ($sumoutgroupproject>0) {
                echo number_format($sumoutgroupproject, 2);
            }else{
                echo "-";
            }
        ?>
            </td>
            <td class="text-right">
                <?php
        $totalsum=$sumingroupproject+$sumoutgroupproject;
        if($totalsum>0)
        {
            echo number_format($totalsum,2);
        }else{
            echo "-";
        }
        ?>
            </td>
            <td class="text-right">
                <?php
                $sumoutgroupproject_6_in=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
                ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>0])
                ->sum('amount');
                if ($sumoutgroupproject_6_in>0) {
                    echo number_format($sumoutgroupproject_6_in, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td class="text-right">
                <?php
                $sumoutgroupproject_6_out=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
                ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>1])
                ->sum('amount');
                if ($sumoutgroupproject_6_out>0) {
                    echo number_format($sumoutgroupproject_6_out, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td class="text-right">
                <?php
            $sumpoject_6=$sumoutgroupproject_6_in+$sumoutgroupproject_6_out;
            if($sumpoject_6>0)
            {
                echo number_format($sumpoject_6,2);
            }else{
                echo "-";
            }
            ?>
            </td>
            <td class="text-right">
                <?php
                $sumoutgroupproject_12_in=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
                ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
               // ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>0])
                ->sum('amount');
                if ($sumoutgroupproject_12_in>0) {
                    echo number_format($sumoutgroupproject_12_in, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td class="text-right">
                <?php
                $sumoutgroupproject_12_out=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
                ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
               // ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>1])
                ->sum('amount');
                if ($sumoutgroupproject_12_out>0) {
                    echo number_format($sumoutgroupproject_12_out, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td class="text-right">
                <?php
            $sumpoject_12=$sumoutgroupproject_12_in+$sumoutgroupproject_12_out;
            if($sumpoject_12>0)
            {
                echo number_format($sumpoject_12,2);
            }else{
                echo "-";
            }
            ?>
            </td>

            <td class="text-right">
                <?php
                $sumprojectplan_in=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
                ->sum('aproved_amount');
                if ($sumprojectplan_in>0) {
                    echo number_format($sumprojectplan_in, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td class="text-right">
                <?php
                $sumprojectplan_out=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
                ->sum('aproved_amount_oda');
                if ($sumprojectplan_out>0) {
                    echo number_format($sumprojectplan_out, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td>
                <?php
            $sumprojectplan=$sumprojectplan_in+$sumprojectplan_out;
            if($sumprojectplan>0)
            {
                echo number_format($sumprojectplan,2);
            }else{
                echo "-";
            }
            ?>
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <?php
    }
  ?>
        <!---------------------- ລວມ​ທືນ​ທັງ​ໝົດ -------------------------------------------->
        <tr>
            <td>II</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td class="text-center" style=" white-space:nowrap !important;"><?=Yii::t('app','ລວມ​ທືນ​ທັງ​ໝົດ')?></td>
            <td>
                <?php
                $count_total_project_by_status=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
              //  ->andWhere(['project_status_id'=>$projectstatus->id])
                ->count();
                if ($count_total_project_by_status>0) {
                    echo $count_total_project_by_status;
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td class="text-right">
                <?php
                $sum_total_project_by_status_in=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->sum('approved_govt_budget');
                if ($sum_total_project_by_status_in>0) {
                    echo number_format($sum_total_project_by_status_in,2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td>
                <?php
                $sum_total_project_by_status_oda=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['is_oda'=>1])
                ->sum('oda_budget');
                if ($sum_total_project_by_status_oda>0) {
                    echo number_format($sum_total_project_by_status_oda,2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td class="text-right">
                <?php
            $sum_total_all_project_status=$sum_total_project_by_status_in+$sum_total_project_by_status_oda;
            if($sum_total_all_project_status>0)
            {
                echo number_format($sum_total_all_project_status,2);
            }else{
                echo "-";
            }
            ?>
            </td>
            <td class="text-right">
            <?php
                $sum__total_paid_project_by_satatus=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
               // ->andWhere(['project_status_id'=>$projectstatus->id])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>0])
                ->sum('amount');
                if ($sum__total_paid_project_by_satatus>0) {
                    echo number_format($sum__total_paid_project_by_satatus, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td class="text-right">
            <?php
                $sum_total_paid_project_by_satatus_oda=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
               // ->andWhere(['project_status_id'=>$projectstatus->id])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>1])
                ->sum('amount');
                if ($sum_total_paid_project_by_satatus_oda>0) {
                    echo number_format($sum_total_paid_project_by_satatus_oda, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td class="text-right">
            <?php
            $sum_paid_total_all_project_status=$sum__total_paid_project_by_satatus+$sum_total_paid_project_by_satatus_oda;
            if($sum_paid_total_all_project_status>0)
            {
                echo number_format($sum_paid_total_all_project_status,2);
            }else{
                echo "-";
            }
            ?>
            </td>
            <td class="text-right">
                <?php
                    $sum__total_paid_project_by_satatus_12=ProjectPayment::find()
                    ->joinWith(['projectProgression','projectProgression.project'])
                    ->where(['project_year'=>$year-1])
                    // ->andWhere(['project_status_id'=>$projectstatus->id])
                    //  ->andWhere(['payment_type'=>'first_six_months'])
                    ->andWhere(['project_payment.is_oda'=>0])
                    ->sum('amount');
                    if ($sum__total_paid_project_by_satatus_12>0) {
                        echo number_format($sum__total_paid_project_by_satatus_12, 2);
                    }else{
                        echo "-";
                    }
                ?>
            </td>
            <td class="text-right">
                <?php
                    $sum_total_paid_project_by_satatus_oda_12=ProjectPayment::find()
                    ->joinWith(['projectProgression','projectProgression.project'])
                    ->where(['project_year'=>$year-1])
                    // ->andWhere(['project_status_id'=>$projectstatus->id])
                   // ->andWhere(['payment_type'=>'first_six_months'])
                    ->andWhere(['project_payment.is_oda'=>1])
                    ->sum('amount');
                    if ($sum_total_paid_project_by_satatus_oda_12>0) {
                        echo number_format($sum_total_paid_project_by_satatus_oda_12, 2);
                    }else{
                        echo "-";
                    }
                ?>
            </td>
            <td class="text-right">
            <?php
            $sum_paid_total_all_project_status_12=$sum__total_paid_project_by_satatus_12+$sum_total_paid_project_by_satatus_oda_12;
            if($sum_paid_total_all_project_status_12>0)
            {
                echo number_format($sum_paid_total_all_project_status_12,2);
            }else{
                echo "-";
            }
            ?>
            </td>
            <td  class="text-right">
            <?php
                $sum__all_projectplan_by_status=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
               // ->andWhere(['project_status_id'=>$projectstatus->id])
               ->sum('aproved_amount');
                if ($sum__all_projectplan_by_status>0) {
                    echo number_format($sum__all_projectplan_by_status, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td class="text-right">
                <?php
                    $sum_all_projectplan_by_status_oda=ProjectProgression::find()
                    ->joinWith(['project'])
                    ->where(['project_year'=>$year])
                ->sum('aproved_amount_oda');
                    if ($sum_all_projectplan_by_status_oda>0) {
                        echo number_format($sum_all_projectplan_by_status_oda, 2);
                    }else{
                        echo "-";
                    }
                ?>
            </td>
            <td class="text-right">
            <?php
            $sum__total_all_projectplan_by_status=$sum__all_projectplan_by_status+$sum_all_projectplan_by_status_oda;
            if($sum__total_all_projectplan_by_status>0)
            {
                echo number_format($sum__total_all_projectplan_by_status,2);
            }else{
                echo "-";
            }
            ?>
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <!------------------------- ທ​ືນ​ໂຄງ​ການ ODA --------------------------------------------------->
        <tr>
            <td>ກ</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><?=Yii::t('app','ທ​ືນ​ໂຄງ​ການ ODA')?></td>
            <td>
                <?php
                $count_total_project_by_status_oda=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['is_oda'=>1])
                ->count();
                if ($count_total_project_by_status_oda>0) {
                    echo $count_total_project_by_status_oda;
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td class="text-right">-</td>
            <td class="text-right">
                <?php
                $sum_project_by_status_oda=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['is_oda'=>1])
                ->sum('oda_budget');
                if ($sum_project_by_status_oda>0) {
                    echo number_format($sum_project_by_status_oda,2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td class="text-right">
                <?php
                    if ($sum_project_by_status_oda>0) {
                        echo number_format($sum_project_by_status_oda,2);
                    }else{
                        echo "-";
                    }
                ?>
            </td>
            <td class="text-right">-</td>
            <td class="text-right">
            <?php
                $sum_paid_project_by_satatus_oda=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
               // ->andWhere(['project_status_id'=>$projectstatus->id])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>1])
                ->sum('amount');
                if ($sum_paid_project_by_satatus_oda>0) {
                    echo number_format($sum_paid_project_by_satatus_oda, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td class="text-right">
            <?php
                if ($sum_paid_project_by_satatus_oda>0) {
                    echo number_format($sum_paid_project_by_satatus_oda, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td class="text-right">-</td>
            <td class="text-right">
            <?php
                $sum_paid_project_by_satatus_oda_12=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
               // ->andWhere(['project_status_id'=>$projectstatus->id])
               // ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>1])
                ->sum('amount');
                if ($sum_paid_project_by_satatus_oda_12>0) {
                    echo number_format($sum_paid_project_by_satatus_oda_12, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td class="text-right">
            <?php
                if ($sum_paid_project_by_satatus_oda_12>0) {
                    echo number_format($sum_paid_project_by_satatus_oda_12, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td  class="text-right">-</td>
            <td class="text-right">
                <?php
                    $sum_projectplan_by_status_oda=ProjectProgression::find()
                    ->joinWith(['project'])
                    ->where(['project_year'=>$year])
                ->sum('aproved_amount_oda');
                    if ($sum_projectplan_by_status_oda>0) {
                        echo number_format($sum_projectplan_by_status_oda, 2);
                    }else{
                        echo "-";
                    }
                ?>
            </td>
            <td class="text-right">
            <?php
                if ($sum_projectplan_by_status_oda>0) {
                    echo number_format($sum_projectplan_by_status_oda, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <!--------------------- foreeach Project status -------------------------->
        <?php
        $projectstatuss=ProjectStatus::find()->orderBy('id asc')->all();
        $a=['ຂ','ຄ','ງ'];
        foreach ($projectstatuss as $key=>$projectstatus) {
        ?>
        <tr>
            <td><?=$a[$key]?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><?=$projectstatus->project_status?></td>
            <td class="text-center">
                <?php
                $count_project_by_status=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['project_status_id'=>$projectstatus->id])
                ->count();
                if ($count_project_by_status>0) {
                    echo $count_project_by_status;
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td class="text-right">
                <?php
                $sum_project_by_status_in=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['project_status_id'=>$projectstatus->id])
                ->sum('approved_govt_budget');
                if ($sum_project_by_status_in>0) {
                    echo number_format($sum_project_by_status_in,2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td class="text-right">-</td>
            <td class="text-right">
            <?php
            if ($sum_project_by_status_in>0) {
                echo number_format($sum_project_by_status_in,2);
            }else{
                echo "-";
            }
            ?>
            </td>
            <td class="text-right">
            <?php
                $sum_paid_project_by_satatus=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
                ->andWhere(['project_status_id'=>$projectstatus->id])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>0])
                ->sum('amount');
                if ($sum_paid_project_by_satatus>0) {
                    echo number_format($sum_paid_project_by_satatus, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td class="text-right">-</td>
            <td class="text-right">
            <?php
                if ($sum_paid_project_by_satatus>0) {
                    echo number_format($sum_paid_project_by_satatus, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td class="text-right">
            <?php
                $sum_paid_project_by_satatus_12=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
                ->andWhere(['project_status_id'=>$projectstatus->id])
               // ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>0])
                ->sum('amount');
                if ($sum_paid_project_by_satatus_12>0) {
                    echo number_format($sum_paid_project_by_satatus_12, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td class="text-right">-</td>
            <td class="text-right">
            <?php
                if ($sum_paid_project_by_satatus_12>0) {
                    echo number_format($sum_paid_project_by_satatus_12, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td  class="text-right">
            <?php
                $sum_projectplan_by_status=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['project_status_id'=>$projectstatus->id])
               ->sum('aproved_amount');
                if ($sum_projectplan_by_status>0) {
                    echo number_format($sum_projectplan_by_status, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td  class="text-right">-</td>
            <td class="text-right">
            <?php
                if ($sum_projectplan_by_status>0) {
                    echo number_format($sum_projectplan_by_status, 2);
                }else{
                    echo "-";
                }
            ?>
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <?php
}
    ?>
    </table>
</div>