<?php

use app\models\Project;
use app\models\ProjectPayment;
use app\models\ProjectProgression;
$year=date('Y');
?>
<table class="table table-bordered">
    <tr>
        <td rowspan="2" align="center"><b>ລ/ດ</b></td>
        <td colspan="3" align="center"><b>ເລກລະຫັດ</b></td>
        <td rowspan="2" align="center"><b>ຊື່ ແລະ ທີ່ຕັ້ງຂອງໂຄງການ</b></td>
        <td rowspan="2" align="center"><b>ຈໍານວນ ໂຄງການ</b></td>
        <td colspan="2" align="center"><b>ໄລຍະໂຄງການ</b></td>
        <td colspan="3" align="center"><b>ມູນຄ່າລວມໂຄງການ (ຕາມສັນຍາ)</b></td>
        <td colspan="3" align="center"><b>ມູນຄ່າຊໍາລະຕົວຈິງ<br />
                ຮອດວັນທີ 31/12/<?=$year-1?></b></td>
        <td colspan="3" align="center"><b>ແຜນການປີ <?=$year?></b></td>
        <td colspan="3" align="center"><b>ມູນຄ່າຊໍາລະ 6 ເດືອນຕົ້ນປີ</b></td>
        <td colspan="3" align="center"><b>ຍັງຄ້າງຈ່າຍຕາມສັນຍາ</b></td>
        <td colspan="3" align="center"><b>ສົມທຽບການປະຕິບັດກັບແຜນປີ <?=$year?></b></td>
        <td rowspan="2" align="center"><b>ໝາຍເຫດ</b></td>
    </tr>
    <tr>
        <td>ຂະແໜງ ການ</td>
        <td>ໂຄງການ</td>
        <td>ສາລະບານງົບປະມານ</td>
        <td>ປະຕິບັດ</td>
        <td>ຊໍາລະ</td>
        <td>ທຶນ ພນ</td>
        <td>ທຶນ ຕປທ</td>
        <td>ລວມ</td>
        <td>ທຶນ ພນ</td>
        <td>ທຶນ ຕປທ</td>
        <td>ລວມ</td>
        <td>ທຶນ ພນ</td>
        <td>ທຶນ ຕປທ</td>
        <td>ລວມ</td>
        <td>ທຶນ ພນ</td>
        <td>ທຶນ ຕປທ</td>
        <td>ລວມ</td>
        <td>ທຶນ ພນ</td>
        <td>ທຶນ ຕປທ</td>
        <td>ລວມ</td>
        <td>ທຶນ ພນ</td>
        <td>ທຶນ ຕປທ</td>
        <td>ລວມ</td>
    </tr>
    <!---------- ລວມປະເພດໂຄງການລົງທຶນຂອງລັດ ---------------------------------------------------------------->

    <tr>
        <td>I</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td style=" white-space:nowrap !important;">
            <?=Yii::t('app', 'ລວມປະເພດໂຄງການລົງທຶນຂອງລັດ')?>
        </td>
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
            } else {
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
            } else {
                echo "-";
            }
        ?>
        </td>
        <td>
            <?php
            $sumttatol=$sumgroupproject+$sumoutgroupproject;
            if ($sumttatol>0) {
                echo number_format($sumttatol, 2);
            } else {
                echo "-";
            }
        ?>
        </td>
        <td class="text-right">
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
                } else {
                    echo "-";
                }
            ?>
        </td>
        <td class="text-right">
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
                } else {
                    echo "-";
                }
            ?>
        </td>
        <td>
            <?php
            $sumtatol_12=$sumtotalgroupproject_12_in+$sumtotalgroupproject_12_out;
            if ($sumtatol_12>0) {
                echo number_format($sumtatol_12, 2);
            } else {
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
                } else {
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
                } else {
                    echo "-";
                }
            ?>
        </td>
        <td>
            <?php
            $sumptotalrojectplan=$sumptotalrojectplan_in+$sumptotalrojectplan_out;
            if ($sumptotalrojectplan>0) {
                echo number_format($sumptotalrojectplan, 2);
            } else {
                echo "-";
            }
            ?>
        </td>
        <td class="text-right">
            <?php
                $sumtotalgroupproject_6_in=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year])
               // ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>0])
                ->sum('amount');
                if ($sumtotalgroupproject_6_in>0) {
                    echo number_format($sumtotalgroupproject_6_in, 2);
                } else {
                    echo "-";
                }
            ?>
        </td>
        <td class="text-right">
            <?php
                $sumtotalgroupproject_6_out=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year])
               // ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>1])
                ->sum('amount');
                if ($sumtotalgroupproject_6_out>0) {
                    echo number_format($sumtotalgroupproject_6_out, 2);
                } else {
                    echo "-";
                }
            ?>
        </td>
        <td>
            <?php
            $sumtatol_6=$sumtotalgroupproject_6_in+$sumtotalgroupproject_6_out;
            if ($sumtatol_6>0) {
                echo number_format($sumtatol_6, 2);
            } else {
                echo "-";
            }
            ?>
        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        
        <td>
        <?php
            $compare_percent_in=($sumtotalgroupproject_6_in/$sumptotalrojectplan_in)*100;
            if ($compare_percent_in>0) {
                echo number_format($compare_percent_in, 2)."%";
            } else {
                echo "-";
            }
        ?>
        </td>
        <td>
        <?php
            $compare_percent_out=($sumtotalgroupproject_6_out/$sumptotalrojectplan_out)*100;
            if ($compare_percent_out>0) {
                echo number_format($compare_percent_out, 2)."%";
            } else {
                echo "-";
            }
        ?>
        </td>
        <td>
        <?php
            $compare_percent_total=($sumtatol_6/$sumptotalrojectplan)*100;
            if ($compare_percent_total>0) {
                echo number_format($compare_percent_total, 2)."%";
            } else {
                echo "-";
            }
        ?>
        </td>
        <td>&nbsp;</td>
    </tr>
    <tr>
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
</table>