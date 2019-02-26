<?php

use app\models\Project;
use app\models\ProjectPayment;
use app\models\ProjectProgression;
use app\models\GroupProjectType;
use app\models\ProjectStatus;
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
        <td class="text-right">
            <?php
            $progressions=ProjectProgression::find()->where(['project_year'=>$year])->all();
            $project_id=[];
            foreach($progressions as $progression)
            {
                $project_id[]=$progression->project_id;
            }
            $payment_all_in=ProjectPayment::find()
            ->joinWith(['projectProgression','projectProgression.project'])
            ->where(['IN','project_id',$project_id])
            ->andWhere(['project_payment.is_oda'=>0])
            ->sum('amount');

            $sumgroupproject=Project::find()
            ->joinWith('projectProgressions')
            ->where(['project_year'=>$year])
            ->andWhere(['not', ['approved_govt_budget' => null]])
            ->sum('approved_govt_budget');
            $total_still_pay_in=$sumgroupproject-$payment_all_in;
            if($total_still_pay_in>0)
            {
                echo number_format($total_still_pay_in,2);
            }else{
                echo "-";
            }
        ?>
        </td>
        <td class="text-right">
            <?php
             $payment_all_oda=ProjectPayment::find()
             ->joinWith(['projectProgression','projectProgression.project'])
             ->where(['IN','project_id',$project_id])
             ->andWhere(['project_payment.is_oda'=>1])
             ->sum('amount');

            $sumgroupproject_out=Project::find()
            ->joinWith('projectProgressions')
            ->where(['project_year'=>$year])
            //->andWhere(['not', ['approved_govt_budget' => null]])
            ->sum('oda_budget');
            $total_still_pay_out=$sumgroupproject_out-$payment_all_oda;
            if($total_still_pay_out>0)
            {
                echo number_format($total_still_pay_out,2);
            }else{
                echo "-";
            }
            ?>
        </td>
        <td class="text-right">
            <?php
            $total_still_pay_all=$total_still_pay_in+$total_still_pay_out;
            if($total_still_pay_all>0)
            {
                echo number_format($total_still_pay_all,2);
            }else{
                echo "-";
            }
            ?>
        </td>

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

    <!-------------------- ໂຄງ​ການ​ລົງ​ທືນ​ຂອງ​ລັດ​ລະ​ດັບ​ຊາດ ---------------------------------------------------->
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>ໂຄງ​ການ​ລົງ​ທືນ​ຂອງ​ລັດ​ລະ​ດັບ​ຊາດ</td>
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

    <!---------- ໂຄງ​ການ​ລົງ​ທືນ​ຂອງ​ລັດ​ປົກ​ກະ​ຕິ ---------------------------------------------------------------->

    <tr>
        <td></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td style=" white-space:nowrap !important;">
            <?=Yii::t('app', 'ໂຄງ​ການ​ລົງ​ທືນ​ຂອງ​ລັດ​ປົກ​ກະ​ຕິ')?>
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
        <td class="text-right">
            <?php
            $progressions=ProjectProgression::find()->where(['project_year'=>$year])->all();
            $project_id=[];
            foreach($progressions as $progression)
            {
                $project_id[]=$progression->project_id;
            }
            $payment_all_in=ProjectPayment::find()
            ->joinWith(['projectProgression','projectProgression.project'])
            ->where(['IN','project_id',$project_id])
            ->andWhere(['project_payment.is_oda'=>0])
            ->sum('amount');

            $sumgroupproject=Project::find()
            ->joinWith('projectProgressions')
            ->where(['project_year'=>$year])
            ->andWhere(['not', ['approved_govt_budget' => null]])
            ->sum('approved_govt_budget');
            $total_still_pay_in=$sumgroupproject-$payment_all_in;
            if($total_still_pay_in>0)
            {
                echo number_format($total_still_pay_in,2);
            }else{
                echo "-";
            }
        ?>
        </td>
        <td class="text-right">
            <?php
             $payment_all_oda=ProjectPayment::find()
             ->joinWith(['projectProgression','projectProgression.project'])
             ->where(['IN','project_id',$project_id])
             ->andWhere(['project_payment.is_oda'=>1])
             ->sum('amount');

            $sumgroupproject_out=Project::find()
            ->joinWith('projectProgressions')
            ->where(['project_year'=>$year])
            //->andWhere(['not', ['approved_govt_budget' => null]])
            ->sum('oda_budget');
            $total_still_pay_out=$sumgroupproject_out-$payment_all_oda;
            if($total_still_pay_out>0)
            {
                echo number_format($total_still_pay_out,2);
            }else{
                echo "-";
            }
            ?>
        </td>
        <td class="text-right">
            <?php
            $total_still_pay_all=$total_still_pay_in+$total_still_pay_out;
            if($total_still_pay_all>0)
            {
                echo number_format($total_still_pay_all,2);
            }else{
                echo "-";
            }
            ?>
        </td>

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

    <!------------------------------ By gruop budget --------------------------------------->
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
            } else {
                echo "-";
            } ?>
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
        } else {
            echo "-";
        } ?>
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
        } else {
            echo "-";
        } ?>
        </td>
        <td class="text-right">
            <?php
        $totalsum=$sumingroupproject+$sumoutgroupproject;
        if ($totalsum>0) {
            echo number_format($totalsum, 2);
        } else {
            echo "-";
        } ?>
        </td>
        <td class="text-right">
            <?php
                $sumtotalgroupproject_12_in=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
                ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
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
                ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
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
        $sum_tatal_plan_12=$sumtotalgroupproject_12_in+$sumtotalgroupproject_12_out;

        if ($sum_tatal_plan_12>0) {
            echo number_format($sum_tatal_plan_12, 2);
        } else {
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
                } else {
                    echo "-";
                } ?>
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
                } else {
                    echo "-";
                } ?>
        </td>
        <td>
            <?php
            $sumprojectplan=$sumprojectplan_in+$sumprojectplan_out;
            if ($sumprojectplan>0) {
                echo number_format($sumprojectplan, 2);
            } else {
                echo "-";
            } ?>
        </td>
        <td class="text-right">
            <?php
                $sumoutgroupproject_6_in=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year])
                ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>0])
                ->sum('amount');
                if ($sumoutgroupproject_6_in>0) {
                    echo number_format($sumoutgroupproject_6_in, 2);
                } else {
                    echo "-";
                } ?>
        </td>
        <td class="text-right">
            <?php
                $sumoutgroupproject_6_out=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year])
                ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>1])
                ->sum('amount');
                if ($sumoutgroupproject_6_out>0) {
                    echo number_format($sumoutgroupproject_6_out, 2);
                } else {
                    echo "-";
                } ?>
        </td>
        <td class="text-right">
            <?php
            $sumpoject_6=$sumoutgroupproject_6_in+$sumoutgroupproject_6_out;
            if ($sumpoject_6>0) {
                echo number_format($sumpoject_6, 2);
            } else {
                echo "-";
            } ?>
        </td>
        <td class="text-right">
            <?php
             $payment_all_in=ProjectPayment::find()
             ->joinWith(['projectProgression','projectProgression.project'])
             ->where(['IN','project_id',$project_id])
             ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
             ->andWhere(['project_payment.is_oda'=>0])
             ->sum('amount');

            $sumgroupproject_in=Project::find()
            ->joinWith('projectProgressions')
            ->where(['project_year'=>$year])
            //->andWhere(['not', ['approved_govt_budget' => null]])
            ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
                
            ->sum('approved_govt_budget');
            $total_still_pay_in=$sumgroupproject_in-$payment_all_in;
            if($total_still_pay_in>0)
            {
                echo number_format($total_still_pay_in,2);
            }else{
                echo "-";
            }
            ?>
        </td>
        <td class="text-right">
            <?php
             $payment_all_oda=ProjectPayment::find()
             ->joinWith(['projectProgression','projectProgression.project'])
             ->where(['IN','project_id',$project_id])
             ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
             ->andWhere(['project_payment.is_oda'=>1])
             ->sum('amount');

            $sumgroupproject_out=Project::find()
            ->joinWith('projectProgressions')
            ->where(['project_year'=>$year])
            //->andWhere(['not', ['approved_govt_budget' => null]])
            ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
                
            ->sum('oda_budget');
            $total_still_pay_out=$sumgroupproject_out-$payment_all_oda;
            if($total_still_pay_out>0)
            {
                echo number_format($total_still_pay_out,2);
            }else{
                echo "-";
            }
            ?>
        </td>
        <td class="text-right">
            <?php
            $total_still_pay_all=$total_still_pay_in+$total_still_pay_out;
            if($total_still_pay_all>0)
            {
                echo number_format($total_still_pay_all,2);
            }else{
                echo "-";
            }
        ?>
        </td>
        <td class="text-right">
            <?php
            if($sumprojectplan_in>0)
            {
                $compare_percent_in_bygroup=($sumoutgroupproject_6_in/$sumprojectplan_in)*100;
                if ($compare_percent_in_bygroup>0) {
                    echo number_format($compare_percent_in_bygroup, 2)."%";
                }
            } else {
                echo "-";
            }
        ?>
        </td>
        <td class="text-right">
            <?php
            if($sumprojectplan_out>0)
            {
                $compare_percent_out_bygroup=($sumoutgroupproject_6_out/$sumprojectplan_out)*100;
                if ($compare_percent_out_bygroup>0) {
                    echo number_format($compare_percent_out_bygroup, 2)."%";
                }
            } else {
                echo "-";
            }
        ?>
        </td>
        <td class="text-right">
            <?php
            if($sumprojectplan>0)
            {
                $compare_percent_all_bygroup=($sumpoject_6/$sumprojectplan)*100;
                if ($compare_percent_all_bygroup>0) {
                    echo number_format($compare_percent_all_bygroup, 2)."%";
                }
            } else {
                echo "-";
            }
        ?>
        </td>
        <td>&nbsp;</td>
    </tr>
    <?php
    }
    ?>

    <!-------------------- ລວມ​ທືນ​ທັງ​ໝົດ ---------------------------------------------------->
    <tr>
        <td>II</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td style=" white-space:nowrap !important;">
            <?=Yii::t('app', 'ລວມ​ທືນ​ທັງ​ໝົດ')?>
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
        <td class="text-right">
            <?php
            $progressions=ProjectProgression::find()->where(['project_year'=>$year])->all();
            $project_id=[];
            foreach($progressions as $progression)
            {
                $project_id[]=$progression->project_id;
            }
            $payment_all_in=ProjectPayment::find()
            ->joinWith(['projectProgression','projectProgression.project'])
            ->where(['IN','project_id',$project_id])
            ->andWhere(['project_payment.is_oda'=>0])
            ->sum('amount');

            $sumgroupproject=Project::find()
            ->joinWith('projectProgressions')
            ->where(['project_year'=>$year])
            ->andWhere(['not', ['approved_govt_budget' => null]])
            ->sum('approved_govt_budget');
            $total_still_pay_in=$sumgroupproject-$payment_all_in;
            if($total_still_pay_in>0)
            {
                echo number_format($total_still_pay_in,2);
            }else{
                echo "-";
            }
        ?>
        </td>
        <td class="text-right">
            <?php
             $payment_all_oda=ProjectPayment::find()
             ->joinWith(['projectProgression','projectProgression.project'])
             ->where(['IN','project_id',$project_id])
             ->andWhere(['project_payment.is_oda'=>1])
             ->sum('amount');

            $sumgroupproject_out=Project::find()
            ->joinWith('projectProgressions')
            ->where(['project_year'=>$year])
            //->andWhere(['not', ['approved_govt_budget' => null]])
            ->sum('oda_budget');
            $total_still_pay_out=$sumgroupproject_out-$payment_all_oda;
            if($total_still_pay_out>0)
            {
                echo number_format($total_still_pay_out,2);
            }else{
                echo "-";
            }
            ?>
        </td>
        <td class="text-right">
            <?php
            $total_still_pay_all=$total_still_pay_in+$total_still_pay_out;
            if($total_still_pay_all>0)
            {
                echo number_format($total_still_pay_all,2);
            }else{
                echo "-";
            }
            ?>
        </td>

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
    <!------------------------- ທ​ືນ​ໂຄງ​ການ ODA --------------------------------------------------->
    <tr>
        <td>ກ</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><?=Yii::t('app', 'ທ​ືນ​ໂຄງ​ການ ODA')?></td>
        <td class="text-center">
            <?php
                $count_total_project_by_status_oda=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['is_oda'=>1])
                ->count();
                if ($count_total_project_by_status_oda>0) {
                    echo $count_total_project_by_status_oda;
                } else {
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
                    echo number_format($sum_project_by_status_oda, 2);
                } else {
                    echo "-";
                }
            ?>
        </td>
        <td class="text-right">
            <?php
                    if ($sum_project_by_status_oda>0) {
                        echo number_format($sum_project_by_status_oda, 2);
                    } else {
                        echo "-";
                    }
                ?>
        </td>
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
    <!-------------------- foreeach Project status ---------------------------------------------------->
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
            } else {
                echo "-";
            } ?>
        </td>
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
    <?php
        }
    ?>
</table>