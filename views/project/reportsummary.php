<?php

use app\models\Project;
use app\models\ProjectPayment;
use app\models\ProjectProgression;
use app\models\GroupProjectType;
use app\models\ProjectStatus;
use app\models\ProjectType;
use yii\widgets\ActiveForm;
$script = <<< JS
    $(function(){
    $('#export').click(function () {
        var mysave = $('#textBox').html();
        $('#csv').val(mysave);
    });
});
JS;
$this->registerJs($script);

if(isset($_POST['year']) && !empty($_POST['year']))
{
    $year=(int)$_POST['year'];
}else{
    $year=date('Y');
}
?>
<div class="row">
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-6">
        <label>ປີ</label>
        <input type="text" name="year" class="form-control" value="<?=$year?>">
    </div>
    <div class="col-md-2" style="padding-top:25px;">
        <button type="submit" class="btn btn-primary">
            <li class="glyphicon glyphicon-eye-open"></li> ເບີ່ງ
        </button>
    </div>
    <?php ActiveForm::end(); ?>
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-4 text-right" style="padding-top:25px;">
        <input type='hidden' id="csv" name="csv" />
        <button id="export" type="submit" class="btn btn-danger" name="export">
            <li class="glyphicon glyphicon-download"></li> EXCEL
        </button>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<hr />
<div id="textBox">
    <div align="center">
        <h3><?=Yii::t('app','ແຜນ​ການ​ລົງ​ທືນ​ຂອງ​ລັດ ປີ').$year?></h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <td colspan="28" align="right"><b><?=Yii::t('app','ຫົວ​ໜ່ວຍ:ລ້ານ​ກີບ')?></b></td>
            </tr>
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
                    if($sumptotalrojectplan_in>0)
                    {
            $compare_percent_in=($sumtotalgroupproject_6_in/$sumptotalrojectplan_in)*100;
            if ($compare_percent_in>0) {
                echo number_format($compare_percent_in, 2)."%";
            } else {
                echo "-";
            }
        }else{
            echo "-";
            }
        ?>
                </td>
                <td>
                    <?php
                    if ($sumptotalrojectplan_out>0) {
                        $compare_percent_out=($sumtotalgroupproject_6_out/$sumptotalrojectplan_out)*100;
                        if ($compare_percent_out>0) {
                            echo number_format($compare_percent_out, 2)."%";
                        } else {
                            echo "-";
                        }
                    }else{
                        echo "-";
                    }
        ?>
                </td>
                <td>
                    <?php
                    if ($sumptotalrojectplan>0) {
                        $compare_percent_total=($sumtatol_6/$sumptotalrojectplan)*100;
                        if ($compare_percent_total>0) {
                            echo number_format($compare_percent_total, 2)."%";
                        } else {
                            echo "-";
                        }
                    }else{
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
            if ($sumptotalrojectplan_in>0) {
                $compare_percent_in=($sumtotalgroupproject_6_in/$sumptotalrojectplan_in)*100;
                if ($compare_percent_in>0) {
                    echo number_format($compare_percent_in, 2)."%";
                } else {
                    echo "-";
                }
            }else{
                echo "-";
            }
        ?>
                </td>
                <td>
                    <?php
            if ($sumptotalrojectplan_out>0) {
                $compare_percent_out=($sumtotalgroupproject_6_out/$sumptotalrojectplan_out)*100;
                if ($compare_percent_out>0) {
                    echo number_format($compare_percent_out, 2)."%";
                } else {
                    echo "-";
                }
            }else{
                echo "-";
            }
        ?>
                </td>
                <td>
                    <?php
            if ($sumptotalrojectplan>0) {
                $compare_percent_total=($sumtatol_6/$sumptotalrojectplan)*100;
                if ($compare_percent_total>0) {
                    echo number_format($compare_percent_total, 2)."%";
                } else {
                    echo "-";
                }
            }else{
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
                <td class="text-right">
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
                <td class="text-right">
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
                <td class="text-right">
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

                <td class="text-right">
                    <?php
            if ($sumptotalrojectplan_in>0) {
                $compare_percent_in=($sumtotalgroupproject_6_in/$sumptotalrojectplan_in)*100;
                if ($compare_percent_in>0) {
                    echo number_format($compare_percent_in, 2)."%";
                } else {
                    echo "-";
                }
            }else{
                echo"-";
            }
        ?>
                </td>
                <td class="text-right">
                    <?php
            if ($sumptotalrojectplan_out>0) {
                $compare_percent_out=($sumtotalgroupproject_6_out/$sumptotalrojectplan_out)*100;
                if ($compare_percent_out>0) {
                    echo number_format($compare_percent_out, 2)."%";
                } else {
                    echo "-";
                }
            }else{
                echo "-";
            }
        ?>
                </td>
                <td class="text-right">
                    <?php
            if ($sumptotalrojectplan>0) {
                $compare_percent_total=($sumtatol_6/$sumptotalrojectplan)*100;
                if ($compare_percent_total>0) {
                    echo number_format($compare_percent_total, 2)."%";
                } else {
                    echo "-";
                }
            }else{
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
                <td class="text-right">-</td>
                <td class="text-right">
                    <?php
             $payment_all_oda=ProjectPayment::find()
             ->joinWith(['projectProgression','projectProgression.project'])
             ->where(['project_year'=>$year-1])
             ->andWhere(['project_payment.is_oda'=>1])
             ->sum('amount');
            if($payment_all_oda>0)
            {
                echo number_format($payment_all_oda,2);
            }else{
                echo "-";
            }
            ?>
                </td>
                <td class="text-right">
                    <?php
                if($payment_all_oda>0)
                {
                    echo number_format($payment_all_oda,2);
                }else{
                    echo "-";
                }
            ?>
                </td>
                <td class="text-right">-</td>
                <td class="text-right">
                    <?php
                $sumptotalrojectplan_oda=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
               // ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
                ->sum('aproved_amount_oda');
                if ($sumptotalrojectplan_oda>0) {
                    echo number_format($sumptotalrojectplan_oda, 2);
                } else {
                    echo "-";
                }
            ?>
                </td>
                <td class="text-right">
                    <?php
            if ($sumptotalrojectplan_oda>0) {
                echo number_format($sumptotalrojectplan_oda, 2);
            } else {
                echo "-";
            }
        ?>
                </td>
                <td class="text-right">-</td>
                <td class="text-right">
                    <?php
                $sumtotalgroupproject_6_oda=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year])
               // ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>1])
                ->sum('amount');
                if ($sumtotalgroupproject_6_oda>0) {
                    echo number_format($sumtotalgroupproject_6_oda, 2);
                } else {
                    echo "-";
                }
            ?>
                </td>
                <td class="text-right">
                    <?php
            if ($sumtotalgroupproject_6_oda>0) {
                echo number_format($sumtotalgroupproject_6_oda, 2);
            } else {
                echo "-";
            }
        ?>
                </td>
                <td class="text-right">-</td>
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
            $total_still_pay_oda=$sumgroupproject_out-$payment_all_oda;
            if($total_still_pay_oda>0)
            {
                echo number_format($total_still_pay_oda,2);
            }else{
                echo "-";
            }
            ?>
                </td>
                <td class="text-right">
                    <?php
                if($total_still_pay_oda>0)
                {
                    echo number_format($total_still_pay_oda,2);
                }else{
                    echo "-";
                }
            ?>
                </td>

                <td class="text-right">-</td>
                <td class="text-right">
                    <?php
            if ($sumptotalrojectplan_oda>0) {
                $compare_percent_oad=($sumtotalgroupproject_6_oda/$sumptotalrojectplan_oda)*100;
                if ($compare_percent_oad>0) {
                    echo number_format($compare_percent_oad, 2)."%";
                } else {
                    echo "-";
                }
            }else{
                echo "-";
            }
        ?>
                </td>
                <td class="text-right">
                    <?php
            if ($sumptotalrojectplan_oda>0) {
                $compare_percent_oad=($sumtotalgroupproject_6_oda/$sumptotalrojectplan_oda)*100;
                if ($compare_percent_oad>0) {
                    echo number_format($compare_percent_oad, 2)."%";
                } else {
                    echo "-";
                }
            }else{
                echo "-";
            }
        ?>
                </td>
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
                <td class="text-right">
                    <?php
                $sum_project_by_status_in=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['project_status_id'=>$projectstatus->id])
                ->sum('approved_govt_budget');
            if ($sum_project_by_status_in>0) {
                echo number_format($sum_project_by_status_in, 2);
            } else {
                echo "-";
            } ?>
                <td class="text-right">-</td>
                <td class="text-right">
                    <?php
            if ($sum_project_by_status_in>0) {
                echo number_format($sum_project_by_status_in, 2);
            } else {
                echo "-";
            } ?>
                </td>
                <td class="text-right">
                    <?php
             $payment_all_in_by_status=ProjectPayment::find()
             ->joinWith(['projectProgression','projectProgression.project'])
             ->where(['project_year'=>$year-1])
             ->andWhere(['project_payment.is_oda'=>0])
             ->andWhere(['project_status_id'=>$projectstatus->id])
             ->sum('amount');
            if($payment_all_in_by_status>0)
            {
                echo number_format($payment_all_in_by_status,2);
            }else{
                echo "-";
            }
            ?>
                </td>
                <td class="text-right">-</td>
                <td class="text-right">
                    <?php
            if($payment_all_in_by_status>0)
            {
                echo number_format($payment_all_in_by_status,2);
            }else{
                echo "-";
            }
        ?>
                </td>
                <td class="text-right">
                    <?php
                $sumptotalrojectplan_in_by_status=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['project_status_id'=>$projectstatus->id])
               // ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
                ->sum('aproved_amount');
                if ($sumptotalrojectplan_in_by_status>0) {
                    echo number_format($sumptotalrojectplan_in_by_status, 2);
                } else {
                    echo "-";
                }
            ?>
                </td>
                <td class="text-right">-</td>
                <td class="text-right">
                    <?php
            if ($sumptotalrojectplan_in_by_status>0) {
                echo number_format($sumptotalrojectplan_in_by_status, 2);
            } else {
                echo "-";
            }
        ?>
                </td>
                <td class="text-right">
                    <?php
                $sumtotalgroupproject_6_in_by_status=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year])
               // ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_status_id'=>$projectstatus->id])
                ->andWhere(['project_payment.is_oda'=>0])
                ->sum('amount');
                if ($sumtotalgroupproject_6_in_by_status>0) {
                    echo number_format($sumtotalgroupproject_6_in_by_status, 2);
                } else {
                    echo "-";
                }
            ?>
                </td>
                <td class="text-right">-</td>
                <td class="text-right">
                    <?php
             if ($sumtotalgroupproject_6_in_by_status>0) {
                echo number_format($sumtotalgroupproject_6_in_by_status, 2);
            } else {
                echo "-";
            }
        ?>
                </td>
                <td class="text-right">
                    <?php
            $progressions_status=ProjectProgression::find()
            ->where(['project_year'=>$year])
            ->andWhere(['project_status_id'=>$projectstatus->id])
            ->all();

            $project_id_by_status=[];
            foreach($progressions_status as $progression)
            {
                $project_id_by_status[]=$progression->project_id;
            }

             $payment_all_in_by_status=ProjectPayment::find()
             ->joinWith(['projectProgression','projectProgression.project'])
             ->where(['IN','project_id',$project_id_by_status])
             ->andWhere(['project_payment.is_oda'=>0])
             ->sum('amount');

            $sumgroupproject_int=Project::find()
            ->joinWith('projectProgressions')
            ->where(['project_year'=>$year])
            ->andWhere(['project_status_id'=>$projectstatus->id])
            ->sum('approved_govt_budget');
            $total_still_pay_in_by_status=$sumgroupproject_int-$payment_all_in_by_status;
            if($total_still_pay_in_by_status>0)
            {
                echo number_format($total_still_pay_in_by_status,2);
            }else{
                echo "-";
            }
            ?>
                </td>
                <td class="text-right">-</td>
                <td class="text-right">
                    <?php
            if($total_still_pay_in_by_status>0)
            {
                echo number_format($total_still_pay_in_by_status,2);
            }else{
                echo "-";
            }
            ?>
                </td>
                <td class="text-right">
                    <?php
            if ($sumptotalrojectplan_in_by_status>0) {
                $compare_percent_in_by_status=($sumtotalgroupproject_6_in_by_status/$sumptotalrojectplan_in_by_status)*100;
                if ($compare_percent_in_by_status>0) {
                    echo number_format($compare_percent_in_by_status, 2)."%";
                } else {
                    echo "-";
                }
            }else{
                echo "-";
            }
        ?>
                </td>
                <td class="text-right">-</td>
                <td class="text-right">
                    <?php
            if ($sumptotalrojectplan_in_by_status>0) {
                $compare_percent_in_by_status=($sumtotalgroupproject_6_in_by_status/$sumptotalrojectplan_in_by_status)*100;
                if ($compare_percent_in_by_status>0) {
                    echo number_format($compare_percent_in_by_status, 2)."%";
                } else {
                    echo "-";
                }
            }else{
                echo "-";
            }
        ?>
                </td>
                <td>&nbsp;</td>
            </tr>
            <?php
        }
    ?>


            <!-------------------- ລວມປະ​ເພດ​ການ​ທືນຂອງ​ລັດ ---------------------------------------------------->
            <tr>
                <td>III</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td style=" white-space:nowrap !important;">
                    <?=Yii::t('app', 'ລວມປະ​ເພດ​ການ​ທືນຂອງ​ລັດ')?>
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
                <td class="text-right">
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
                <td class="text-right">
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
                <td class="text-right">
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

                <td class="text-right">
                    <?php
            if ($sumptotalrojectplan_in>0) {
                $compare_percent_in=($sumtotalgroupproject_6_in/$sumptotalrojectplan_in)*100;
                if ($compare_percent_in>0) {
                    echo number_format($compare_percent_in, 2)."%";
                } else {
                    echo "-";
                }
            }else{
                echo "-";
            }
        ?>
                </td>
                <td class="text-right">
                    <?php
            if ($sumptotalrojectplan_out>0) {
                $compare_percent_out=($sumtotalgroupproject_6_out/$sumptotalrojectplan_out)*100;
                if ($compare_percent_out>0) {
                    echo number_format($compare_percent_out, 2)."%";
                } else {
                    echo "-";
                }
            }else{
                echo "-";
            }
        ?>
                </td>
                <td class="text-right">
                    <?php
            if ($sumptotalrojectplan>0) {
                $compare_percent_total=($sumtatol_6/$sumptotalrojectplan)*100;
                if ($compare_percent_total>0) {
                    echo number_format($compare_percent_total, 2)."%";
                } else {
                    echo "-";
                }
            }else{
                echo "-";
            }
        ?>
                </td>
                <td>&nbsp;</td>
            </tr>

            <!---------------------- List Project type ------------------------------------------>
            <?php
    $projecttypes=ProjectType::find()->all();
    $s='';
    foreach ($projecttypes as $projecttype) {
        $s='i'.$s; ?>
            <tr class="bg-info">
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td class="text-center" style=" white-space:nowrap !important;"><?=$projecttype->project_type?></td>
                <td class="text-center">
                    <?php
                $count_total_project_by_status=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['project_type_id'=>$projecttype->id])
              //  ->andWhere(['project_status_id'=>$projectstatus->id])
                ->count();
                if ($count_total_project_by_status>0) {
                    echo $count_total_project_by_status;
                } else {
                    echo "-";
                } ?>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td class="text-right">
                    <?php
                $sum_total_project_by_status_in=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['project_type_id'=>$projecttype->id])
                ->sum('approved_govt_budget');
                if ($sum_total_project_by_status_in>0) {
                    echo number_format($sum_total_project_by_status_in, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td class="text-right">
                    <?php
                $sum_total_project_by_status_oda=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['project_type_id'=>$projecttype->id])
                ->andWhere(['is_oda'=>1])
                ->sum('oda_budget');
                if ($sum_total_project_by_status_oda>0) {
                    echo number_format($sum_total_project_by_status_oda, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td class="text-right">
                    <?php
            $sum_total_all_project_status=$sum_total_project_by_status_in+$sum_total_project_by_status_oda;
                if ($sum_total_all_project_status>0) {
                    echo number_format($sum_total_all_project_status, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td class="text-right">
                    <?php
             $payment_all_in_by_type=ProjectPayment::find()
             ->joinWith(['projectProgression','projectProgression.project'])
             ->where(['project_year'=>$year-1])
             ->andWhere(['project_payment.is_oda'=>0])
             ->andWhere(['project.project_type_id'=>$projecttype->id])
             ->sum('amount');
            if($payment_all_in_by_type>0)
            {
                echo number_format($payment_all_in_by_type,2);
            }else{
                echo "-";
            }
            ?>
                </td>
                <td class="text-right">
                    <?php
             $payment_all_out_by_type=ProjectPayment::find()
             ->joinWith(['projectProgression','projectProgression.project'])
             ->where(['project_year'=>$year-1])
             ->andWhere(['project_payment.is_oda'=>1])
             ->andWhere(['project.project_type_id'=>$projecttype->id])
             ->sum('amount');
            if($payment_all_out_by_type>0)
            {
                echo number_format($payment_all_out_by_type,2);
            }else{
                echo "-";
            }
            ?>
                </td>
                <td class="text-right">
                    <?php
            $payment_all_by_type=$payment_all_in_by_type+$payment_all_out_by_type;
            if($payment_all_by_type>0)
            {
                echo number_format($payment_all_by_type,2);
            }else{
                echo "-";
            }
        ?>
                </td>
                <td class="text-right">
                    <?php
                $sumptotalrojectplan_in_by_type=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['project.project_type_id'=>$projecttype->id])
                ->sum('aproved_amount');
                if ($sumptotalrojectplan_in_by_type>0) {
                    echo number_format($sumptotalrojectplan_in_by_type, 2);
                } else {
                    echo "-";
                }
            ?>
                </td>
                <td class="text-right">
                    <?php
                $sumptotalrojectplan_out_by_type=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['project.project_type_id'=>$projecttype->id])
                ->sum('aproved_amount_oda');
                if ($sumptotalrojectplan_out_by_type>0) {
                    echo number_format($sumptotalrojectplan_out_by_type, 2);
                } else {
                    echo "-";
                }
            ?>
                </td>
                <td class="text-right">
                    <?php
            $sumptotalrojectplan_by_type=$sumptotalrojectplan_in_by_type+$sumptotalrojectplan_out_by_type;
            if($sumptotalrojectplan_by_type>0)
            {
                echo number_format($sumptotalrojectplan_by_type,2);
            }else{
                echo "-";
            }
        ?>
                </td>
                <td class="text-right">
                    <?php
                $sumtotalgroupproject_6_in_by_type=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>0])
                ->andWhere(['project.project_type_id'=>$projecttype->id])
                ->sum('amount');
                if ($sumtotalgroupproject_6_in_by_type>0) {
                    echo number_format($sumtotalgroupproject_6_in_by_type, 2);
                } else {
                    echo "-";
                }
            ?>
                </td>
                <td class="text-right">
                    <?php
                $sumtotalgroupproject_6_out_by_type=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>1])
                ->andWhere(['project.project_type_id'=>$projecttype->id])
                ->sum('amount');
                if ($sumtotalgroupproject_6_out_by_type>0) {
                    echo number_format($sumtotalgroupproject_6_out_by_type, 2);
                } else {
                    echo "-";
                }
            ?>
                </td>
                <td>
                    <?php
            $sumtotal_project_6_all_by_type=$sumtotalgroupproject_6_in_by_type+$sumtotalgroupproject_6_out_by_type;
            if ($sumtotal_project_6_all_by_type>0) {
                echo number_format($sumtotal_project_6_all_by_type, 2);
            } else {
                echo "-";
            }
        ?>
                </td>
                <td class="text-right">
                    <?php
            $progressions_status=ProjectProgression::find()
            ->joinWith(['project'])
            ->where(['project_year'=>$year])
            ->andWhere(['project.project_type_id'=>$projecttype->id])
            ->all();

            $project_id_by_type=[];
            foreach($progressions_status as $progression)
            {
                $project_id_by_type[]=$progression->project_id;
            }

             $payment_all_in_by_type=ProjectPayment::find()
             ->joinWith(['projectProgression','projectProgression.project'])
             ->where(['IN','project_id',$project_id_by_type])
             ->andWhere(['project_payment.is_oda'=>0])
             ->sum('amount');

            $sumgroupproject_in=Project::find()
            ->joinWith('projectProgressions')
            ->where(['project_year'=>$year])
            ->andWhere(['project.project_type_id'=>$projecttype->id])
            ->sum('approved_govt_budget');
            $total_still_pay_in_by_type=$sumgroupproject_in-$payment_all_in_by_type;
            if($total_still_pay_in_by_type>0)
            {
                echo number_format($total_still_pay_in_by_type,2);
            }else{
                echo "-";
            }
            ?>
                </td>
                <td class="text-right">
                    <?php
            $payment_all_out_by_type=ProjectPayment::find()
            ->joinWith(['projectProgression','projectProgression.project'])
            ->where(['IN','project_id',$project_id_by_type])
            ->andWhere(['project_payment.is_oda'=>1])
            ->sum('amount');

           $sumgroupproject_out=Project::find()
           ->joinWith('projectProgressions')
           ->where(['project_year'=>$year])
           ->andWhere(['project.project_type_id'=>$projecttype->id])
           ->sum('oda_budget');
           $total_still_pay_out_by_type=$sumgroupproject_out-$payment_all_out_by_type;
           if($total_still_pay_out_by_type>0)
           {
               echo number_format($total_still_pay_out_by_type,2);
           }else{
               echo "-";
           }
        ?>
                </td>
                <td class="text-right">
                    <?php
            $total_still_pay_all_by_type=$total_still_pay_in_by_type+$total_still_pay_out_by_type;
            if($total_still_pay_all_by_type>0)
            {
                echo number_format($total_still_pay_all_by_type,2);
            }else{
                echo "-";
            }
        ?>
                </td>
                <td class="text-right">
                    <?php
            if ($sumptotalrojectplan_in_by_type>0) {
                $compare_percent_in_by_type=($sumtotalgroupproject_6_in_by_type/$sumptotalrojectplan_in_by_type)*100;
                if ($compare_percent_in_by_type>0) {
                    echo number_format($compare_percent_in_by_type, 2)."%";
                } else {
                    echo "-";
                }
            }else{
                echo "-";
            }
        ?>
                </td>
                <td class="text-right">
                    <?php
            if ($sumptotalrojectplan_out_by_type>0) {
                $compare_percent_out_by_type=($sumtotalgroupproject_6_out_by_type/$sumptotalrojectplan_out_by_type)*100;
                if ($compare_percent_out_by_type>0) {
                    echo number_format($compare_percent_out_by_type, 2)."%";
                } else {
                    echo "-";
                }
            }else{
                echo "-";
            }
        ?>
                </td>
                <td class="text-right">
                    <?php
            if ($sumptotalrojectplan_by_type>0) {
                $compare_percent_total_by_type=($sumtotal_project_6_all_by_type/$sumptotalrojectplan_by_type)*100;
                if ($compare_percent_total_by_type>0) {
                    echo number_format($compare_percent_total_by_type, 2)."%";
                } else {
                    echo "-";
                }
            }else{
                echo "-";
            }
        ?>
                </td>
                <td>&nbsp;</td>
            </tr>
            <!------------------------- ທ​ືນ​ໂຄງ​ການ ODA By Projrct type --------------------------------------------------->
            <tr>
                <td><?=$s?>1</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td style=" white-space:nowrap !important;"><?="ທ​ືນ​ໂຄງ​ການ ODA"?></td>
                <td class="text-center">
                    <?php
                $count_total_project_by_type_oda=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['project_type_id'=>$projecttype->id])
                ->andWhere(['is_oda'=>1])
                ->count();
                if ($count_total_project_by_type_oda>0) {
                    echo $count_total_project_by_type_oda;
                } else {
                    echo "-";
                } ?>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td class="text-right">-</td>
                <td class="text-right">
                    <?php
                $sum_total_project_by_status_oda=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['project_type_id'=>$projecttype->id])
                ->andWhere(['is_oda'=>1])
                ->sum('oda_budget');
                if ($sum_total_project_by_status_oda>0) {
                    echo number_format($sum_total_project_by_status_oda, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td class="text-right">
                    <?php
            if ($sum_total_project_by_status_oda>0) {
                echo number_format($sum_total_project_by_status_oda, 2);
            } else {
                echo "-";
            }?>
                </td>
                <td class="text-right">-</td>
                <td class="text-right">
                    <?php
             $payment_all_out_by_type=ProjectPayment::find()
             ->joinWith(['projectProgression','projectProgression.project'])
             ->where(['project_year'=>$year-1])
             ->andWhere(['project_payment.is_oda'=>1])
             ->andWhere(['project.project_type_id'=>$projecttype->id])
             ->sum('amount');
            if($payment_all_out_by_type>0)
            {
                echo number_format($payment_all_out_by_type,2);
            }else{
                echo "-";
            }
            ?>
                </td>
                <td class="text-right">
                    <?php
            if($payment_all_out_by_type>0)
            {
                echo number_format($payment_all_out_by_type,2);
            }else{
                echo "-";
            }
        ?>
                </td>
                <td class="text-right">-</td>
                <td class="text-right">
                    <?php
                $sumptotalrojectplan_out_by_type=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['project.project_type_id'=>$projecttype->id])
                ->sum('aproved_amount_oda');
                if ($sumptotalrojectplan_out_by_type>0) {
                    echo number_format($sumptotalrojectplan_out_by_type, 2);
                } else {
                    echo "-";
                }
            ?>
                </td>
                <td class="text-right">
                    <?php
           if ($sumptotalrojectplan_out_by_type>0) {
            echo number_format($sumptotalrojectplan_out_by_type, 2);
            } else {
                echo "-";
            }
        ?>
                </td>
                <td class="text-right">-</td>
                <td class="text-right">
                    <?php
                $sumtotalgroupproject_6_out_by_type=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>1])
                ->andWhere(['project.project_type_id'=>$projecttype->id])
                ->sum('amount');
                if ($sumtotalgroupproject_6_out_by_type>0) {
                    echo number_format($sumtotalgroupproject_6_out_by_type, 2);
                } else {
                    echo "-";
                }
            ?>
                </td>
                <td>
                    <?php
            if ($sumtotalgroupproject_6_out_by_type>0) {
                echo number_format($sumtotalgroupproject_6_out_by_type, 2);
            } else {
                echo "-";
            }
        ?>
                </td>
                <td class="text-right">-</td>
                <td class="text-right">
                    <?php
            $payment_all_out_by_type=ProjectPayment::find()
            ->joinWith(['projectProgression','projectProgression.project'])
            ->where(['IN','project_id',$project_id_by_type])
            ->andWhere(['project_payment.is_oda'=>1])
            ->sum('amount');

           $sumgroupproject_out=Project::find()
           ->joinWith('projectProgressions')
           ->where(['project_year'=>$year])
           ->andWhere(['project.project_type_id'=>$projecttype->id])
           ->sum('oda_budget');
           $total_still_pay_out_by_type=$sumgroupproject_out-$payment_all_out_by_type;
           if($total_still_pay_out_by_type>0)
           {
               echo number_format($total_still_pay_out_by_type,2);
           }else{
               echo "-";
           }
        ?>
                </td>
                <td class="text-right">
                    <?php
            if($total_still_pay_out_by_type>0)
            {
                echo number_format($total_still_pay_out_by_type,2);
            }else{
                echo "-";
            }
        ?>
                </td>
                <td class="text-right">-</td>
                <td class="text-right">
                    <?php
            if ($sumptotalrojectplan_out_by_type>0) {
                $compare_percent_out_by_type=($sumtotalgroupproject_6_out_by_type/$sumptotalrojectplan_out_by_type)*100;
                if ($compare_percent_out_by_type>0) {
                    echo number_format($compare_percent_out_by_type, 2)."%";
                } else {
                    echo "-";
                }
            }else{
                echo "-";
            }
        ?>
                </td>
                <td class="text-right">
                    <?php
            if ($sumptotalrojectplan_out_by_type>0) {
                $compare_percent_out_by_type=($sumtotalgroupproject_6_out_by_type/$sumptotalrojectplan_out_by_type)*100;
                if ($compare_percent_out_by_type>0) {
                    echo number_format($compare_percent_out_by_type, 2)."%";
                } else {
                    echo "-";
                }
            }else{
                echo "-";
            }
        ?>
                </td>
                <td>&nbsp;</td>
            </tr>

            <!---------------------- List Project status by type ------------------------------------------>
            <?php
    $projectstatuss=ProjectStatus::find()->all();
    $i=1;
    foreach ($projectstatuss as $projectstatus) {
        $i++; ?>
            <tr>
                <td><?=$s.$i?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td style=" white-space:nowrap !important;"><?=$projectstatus->project_status?></td>
                <td class="text-center">
                    <?php
                $count_total_project_by_status=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['project_type_id'=>$projecttype->id])
                ->andWhere(['project_status_id'=>$projectstatus->id])
                ->count();
        if ($count_total_project_by_status>0) {
            echo $count_total_project_by_status;
        } else {
            echo "-";
        } ?>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td class="text-right">
                    <?php
                $sum_total_project_by_status_in=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['project_type_id'=>$projecttype->id])
                ->andWhere(['project_status_id'=>$projectstatus->id])
                ->sum('approved_govt_budget');
        if ($sum_total_project_by_status_in>0) {
            echo number_format($sum_total_project_by_status_in, 2);
        } else {
            echo "-";
        } ?>
                </td>
                <td class="text-right">
                    <?php
                $sum_total_project_by_status_oda=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['project_type_id'=>$projecttype->id])
                ->andWhere(['project_status_id'=>$projectstatus->id])
                ->andWhere(['is_oda'=>1])
                ->sum('oda_budget');
        if ($sum_total_project_by_status_oda>0) {
            echo number_format($sum_total_project_by_status_oda, 2);
        } else {
            echo "-";
        } ?>
                </td>
                <td class="text-right">
                    <?php
            $sum_total_all_project_status=$sum_total_project_by_status_in+$sum_total_project_by_status_oda;
        if ($sum_total_all_project_status>0) {
            echo number_format($sum_total_all_project_status, 2);
        } else {
            echo "-";
        } ?>
                </td>
                <td class="text-right">
                    <?php
             $payment_all_in_by_type=ProjectPayment::find()
             ->joinWith(['projectProgression','projectProgression.project'])
             ->where(['project_year'=>$year-1])
             ->andWhere(['project_payment.is_oda'=>0])
             ->andWhere(['project.project_type_id'=>$projecttype->id])
             ->andWhere(['project_status_id'=>$projectstatus->id])
             ->sum('amount');
        if ($payment_all_in_by_type>0) {
            echo number_format($payment_all_in_by_type, 2);
        } else {
            echo "-";
        } ?>
                </td>
                <td class="text-right">
                    <?php
             $payment_all_out_by_type=ProjectPayment::find()
             ->joinWith(['projectProgression','projectProgression.project'])
             ->where(['project_year'=>$year-1])
             ->andWhere(['project_payment.is_oda'=>1])
             ->andWhere(['project.project_type_id'=>$projecttype->id])
             ->andWhere(['project_status_id'=>$projectstatus->id])
             ->sum('amount');
        if ($payment_all_out_by_type>0) {
            echo number_format($payment_all_out_by_type, 2);
        } else {
            echo "-";
        } ?>
                </td>
                <td class="text-right">
                    <?php
            $payment_all_by_type=$payment_all_in_by_type+$payment_all_out_by_type;
        if ($payment_all_by_type>0) {
            echo number_format($payment_all_by_type, 2);
        } else {
            echo "-";
        } ?>
                </td>
                <td class="text-right">
                    <?php
                $sumptotalrojectplan_in_by_type=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['project.project_type_id'=>$projecttype->id])
                ->andWhere(['project_status_id'=>$projectstatus->id])
                ->sum('aproved_amount');
        if ($sumptotalrojectplan_in_by_type>0) {
            echo number_format($sumptotalrojectplan_in_by_type, 2);
        } else {
            echo "-";
        } ?>
                </td>
                <td class="text-right">
                    <?php
                $sumptotalrojectplan_out_by_type=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['project.project_type_id'=>$projecttype->id])
                ->andWhere(['project_status_id'=>$projectstatus->id])
                ->sum('aproved_amount_oda');
        if ($sumptotalrojectplan_out_by_type>0) {
            echo number_format($sumptotalrojectplan_out_by_type, 2);
        } else {
            echo "-";
        } ?>
                </td>
                <td class="text-right">
                    <?php
            $sumptotalrojectplan_by_type=$sumptotalrojectplan_in_by_type+$sumptotalrojectplan_out_by_type;
        if ($sumptotalrojectplan_by_type>0) {
            echo number_format($sumptotalrojectplan_by_type, 2);
        } else {
            echo "-";
        } ?>
                </td>
                <td class="text-right">
                    <?php
                $sumtotalgroupproject_6_in_by_type=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>0])
                ->andWhere(['project.project_type_id'=>$projecttype->id])
                ->andWhere(['project_status_id'=>$projectstatus->id])
                ->sum('amount');
        if ($sumtotalgroupproject_6_in_by_type>0) {
            echo number_format($sumtotalgroupproject_6_in_by_type, 2);
        } else {
            echo "-";
        } ?>
                </td>
                <td class="text-right">
                    <?php
                $sumtotalgroupproject_6_out_by_type=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>1])
                ->andWhere(['project.project_type_id'=>$projecttype->id])
                ->andWhere(['project_status_id'=>$projectstatus->id])
                ->sum('amount');
        if ($sumtotalgroupproject_6_out_by_type>0) {
            echo number_format($sumtotalgroupproject_6_out_by_type, 2);
        } else {
            echo "-";
        } ?>
                </td>
                <td>
                    <?php
            $sumtotal_project_6_all_by_type=$sumtotalgroupproject_6_in_by_type+$sumtotalgroupproject_6_out_by_type;
        if ($sumtotal_project_6_all_by_type>0) {
            echo number_format($sumtotal_project_6_all_by_type, 2);
        } else {
            echo "-";
        } ?>
                </td>
                <td class="text-right">
                    <?php
            $progressions_status=ProjectProgression::find()
            ->joinWith(['project'])
            ->where(['project_year'=>$year])
            ->andWhere(['project.project_type_id'=>$projecttype->id])
            ->andWhere(['project_status_id'=>$projectstatus->id])
            ->all();

        $project_id_by_type=[];
        foreach ($progressions_status as $progression) {
            $project_id_by_type[]=$progression->project_id;
        }

        $payment_all_in_by_type=ProjectPayment::find()
             ->joinWith(['projectProgression','projectProgression.project'])
             ->where(['IN','project_id',$project_id_by_type])
             ->andWhere(['project_payment.is_oda'=>0])
             ->sum('amount');

        $sumgroupproject_in=Project::find()
            ->joinWith('projectProgressions')
            ->where(['project_year'=>$year])
            ->andWhere(['project.project_type_id'=>$projecttype->id])
            ->andWhere(['project_status_id'=>$projectstatus->id])
            ->sum('approved_govt_budget');
        $total_still_pay_in_by_type=$sumgroupproject_in-$payment_all_in_by_type;
        if ($total_still_pay_in_by_type>0) {
            echo number_format($total_still_pay_in_by_type, 2);
        } else {
            echo "-";
        } ?>
                </td>
                <td class="text-right">
                    <?php
            $payment_all_out_by_type=ProjectPayment::find()
            ->joinWith(['projectProgression','projectProgression.project'])
            ->where(['IN','project_id',$project_id_by_type])
            ->andWhere(['project_payment.is_oda'=>1])
            ->sum('amount');

        $sumgroupproject_out=Project::find()
           ->joinWith('projectProgressions')
           ->where(['project_year'=>$year])
           ->andWhere(['project.project_type_id'=>$projecttype->id])
           ->andWhere(['project_status_id'=>$projectstatus->id])
           ->sum('oda_budget');
        $total_still_pay_out_by_type=$sumgroupproject_out-$payment_all_out_by_type;
        if ($total_still_pay_out_by_type>0) {
            echo number_format($total_still_pay_out_by_type, 2);
        } else {
            echo "-";
        } ?>
                </td>
                <td class="text-right">
                    <?php
            $total_still_pay_all_by_type=$total_still_pay_in_by_type+$total_still_pay_out_by_type;
        if ($total_still_pay_all_by_type>0) {
            echo number_format($total_still_pay_all_by_type, 2);
        } else {
            echo "-";
        } ?>
                </td>
                <td class="text-right">
                    <?php
            if ($sumptotalrojectplan_in_by_type>0) {
                $compare_percent_in_by_type=($sumtotalgroupproject_6_in_by_type/$sumptotalrojectplan_in_by_type)*100;
                if ($compare_percent_in_by_type>0) {
                    echo number_format($compare_percent_in_by_type, 2)."%";
                } else {
                    echo "-";
                }
            } else {
                echo "-";
            } ?>
                </td>
                <td class="text-right">
                    <?php
            if ($sumptotalrojectplan_out_by_type>0) {
                $compare_percent_out_by_type=($sumtotalgroupproject_6_out_by_type/$sumptotalrojectplan_out_by_type)*100;
                if ($compare_percent_out_by_type>0) {
                    echo number_format($compare_percent_out_by_type, 2)."%";
                } else {
                    echo "-";
                }
            } else {
                echo "-";
            } ?>
                </td>
                <td class="text-right">
                    <?php
            if ($sumptotalrojectplan_by_type>0) {
                $compare_percent_total_by_type=($sumtotal_project_6_all_by_type/$sumptotalrojectplan_by_type)*100;
                if ($compare_percent_total_by_type>0) {
                    echo number_format($compare_percent_total_by_type, 2)."%";
                } else {
                    echo "-";
                }
            } else {
                echo "-";
            } ?>
                </td>
                <td>&nbsp;</td>
            </tr>

            <!---------------------- List Project by type and status ------------------------------------------>
            <?php
            $project_details=ProjectProgression::find()
            ->joinWith(['project'])
            ->where(['project_year'=>$year])
            ->andWhere(['project_type_id'=>$projecttype->id])
            ->andWhere(['project_status_id'=>$projectstatus->id])
            ->all();
            $b=0;
            foreach ($project_details as $project_detail) {
                $b++;
                ?>
            <tr>
                <td><?=$b?></td>
                <td style=" white-space:nowrap !important;"><?=$project_detail->project->sector_code?></td>
                <td style=" white-space:nowrap !important;"><?=$project_detail->project->project_code?></td>
                <td style=" white-space:nowrap !important;"><?=$project_detail->project->budget_code?></td>
                <td style=" white-space:nowrap !important;"><?=$project_detail->project->project_name?></td>
                <td class="text-center">1</td>
                <td style=" white-space:nowrap !important;">
                    <?=$project_detail->project->project_start_year.'-'.$project_detail->project->project_end_year?>
                </td>
                <td style=" white-space:nowrap !important;">
                    <?=$project_detail->project->payment_start_year.'-'.$project_detail->project->payment_end_year?>
                </td>
                <td class="text-right">
                    <?php 
            if($project_detail->project->approved_govt_budget>0)
            {
                echo $project_detail->project->approved_govt_budget;
            }else{
                echo "-";
            }
            ?>
                </td>
                <td class="text-right">
                    <?php 
            if($project_detail->project->oda_budget>0)
            {
                echo $project_detail->project->oda_budget;
            }else{
                echo "-";
            }
            ?>
                </td>
                <td class="text-right">
                    <?php
                $gov_oda_budget=substr(preg_replace('/[^A-Za-z0-9\-]/', '', $project_detail->project->approved_govt_budget), 0, -2)+substr(preg_replace('/[^A-Za-z0-9\-]/', '', $project_detail->project->oda_budget), 0, -2);
                if($gov_oda_budget>0)
                {
                    echo number_format($gov_oda_budget,2);
                }else{
                    echo "-";
                }
            ?>
                </td>
                <td class="text-right">
                    <?php
             $payment_all_in_by_project=ProjectPayment::find()
             ->joinWith(['projectProgression','projectProgression.project'])
             ->where(['project_year'=>$year-1])
             ->andWhere(['project_payment.is_oda'=>0])
             ->andWhere(['project.id'=>$project_detail->project->id])
             ->sum('amount');
        if ($payment_all_in_by_project>0) {
            echo number_format($payment_all_in_by_project, 2);
        } else {
            echo "-";
        } ?>
                </td>
                <td class="text-right">
                    <?php
             $payment_all_out_by_project=ProjectPayment::find()
             ->joinWith(['projectProgression','projectProgression.project'])
             ->where(['project_year'=>$year-1])
             ->andWhere(['project_payment.is_oda'=>1])
             ->andWhere(['project.id'=>$project_detail->project->id])
             ->sum('amount');
        if ($payment_all_out_by_project>0) {
            echo number_format($payment_all_out_by_project, 2);
        } else {
            echo "-";
        } ?>
                </td>
                <td class="text-right">
                    <?php
            $payment_all_by_project=$payment_all_in_by_project+$payment_all_out_by_project;
        if ($payment_all_by_project>0) {
            echo number_format($payment_all_by_project, 2);
        } else {
            echo "-";
        } ?>
                </td>
                <td class="text-right">
                    <?php
                $sumptotalrojectplan_in_project=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['project.id'=>$project_detail->project->id])
                ->sum('aproved_amount');
        if ($sumptotalrojectplan_in_project>0) {
            echo number_format($sumptotalrojectplan_in_project, 2);
        } else {
            echo "-";
        } ?>
                </td>
                <td class="text-right">
                    <?php
                $sumptotalrojectplan_out_project=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['project.id'=>$project_detail->project->id])
                ->sum('aproved_amount_oda');
        if ($sumptotalrojectplan_out_project>0) {
            echo number_format($sumptotalrojectplan_out_project, 2);
        } else {
            echo "-";
        } ?>
                </td>
                <td class="text-right">
                    <?php
            $sumptotalrojectplan_by_project=$sumptotalrojectplan_in_project+$sumptotalrojectplan_out_project;
        if ($sumptotalrojectplan_by_project>0) {
            echo number_format($sumptotalrojectplan_by_project, 2);
        } else {
            echo "-";
        } ?>
                </td>
                <td class="text-right">
                    <?php
                $sumtotalgroupproject_6_in_by_project=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>0])
                ->andWhere(['project.id'=>$project_detail->project->id])
                ->sum('amount');
        if ($sumtotalgroupproject_6_in_by_project>0) {
            echo number_format($sumtotalgroupproject_6_in_by_project, 2);
        } else {
            echo "-";
        } ?>
                </td>
                <td class="text-right">
                    <?php
                $sumtotalgroupproject_6_out_by_project=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>1])
                ->andWhere(['project.id'=>$project_detail->project->id])
                ->sum('amount');
        if ($sumtotalgroupproject_6_out_by_project>0) {
            echo number_format($sumtotalgroupproject_6_out_by_project, 2);
        } else {
            echo "-";
        } ?>
                </td>
                <td>
                    <?php
            $sumtotal_project_6_all_by_project=$sumtotalgroupproject_6_in_by_project+$sumtotalgroupproject_6_out_by_project;
        if ($sumtotal_project_6_all_by_project>0) {
            echo number_format($sumtotal_project_6_all_by_project, 2);
        } else {
            echo "-";
        } ?>
                </td>
                <td class="text-right">
                    <?php
        $payment_all_in_by_project=ProjectPayment::find()
             ->joinWith(['projectProgression','projectProgression.project'])
             ->where(['project.id'=>$project_detail->project->id])
             ->andWhere(['project_payment.is_oda'=>0])
             ->sum('amount');

        $sumgroupproject_in_project=Project::find()
           // ->joinWith('projectProgressions')
            ->where(['project.id'=>$project_detail->project->id])
            ->sum('approved_govt_budget');
        $total_still_pay_in_by_project=$sumgroupproject_in_project-$payment_all_in_by_project;
        if ($total_still_pay_in_by_project>0) {
            echo number_format($total_still_pay_in_by_project, 2);
        } else {
            echo "-";
        } ?>
                </td>
                <td class="text-right">
                    <?php
            $payment_all_out_by_project=ProjectPayment::find()
            ->joinWith(['projectProgression','projectProgression.project'])
            ->where(['project.id'=>$project_detail->project->id])
            ->andWhere(['project_payment.is_oda'=>1])
            ->sum('amount');
        $sumgroupproject_out_project=Project::find()
           ->andWhere(['project.id'=>$project_detail->project->id])
           ->sum('oda_budget');
        $total_still_pay_out_by_project=$sumgroupproject_out_project-$payment_all_out_by_project;
        if ($total_still_pay_out_by_project>0) {
            echo number_format($total_still_pay_out_by_project, 2);
        } else {
            echo "-";
        } ?>
                </td>
                <td class="text-right">
                    <?php
            $total_still_pay_all_by_project=$total_still_pay_in_by_project+$total_still_pay_out_by_project;
        if ($total_still_pay_all_by_project>0) {
            echo number_format($total_still_pay_all_by_project, 2);
        } else {
            echo "-";
        } ?>
                </td>
                <td class="text-right">
                    <?php
            if ($sumptotalrojectplan_in_project>0) {
                $compare_percent_in_by_project=($sumtotalgroupproject_6_in_by_project/$sumptotalrojectplan_in_project)*100;
                if ($compare_percent_in_by_project>0) {
                    echo number_format($compare_percent_in_by_project, 2)."%";
                } else {
                    echo "-";
                }
            } else {
                echo "-";
            } ?>
                </td>
                <td class="text-right">
                    <?php
            if ($sumptotalrojectplan_out_project>0) {
                $compare_percent_out_by_project=($sumtotalgroupproject_6_out_by_project/$sumptotalrojectplan_out_project)*100;
                if ($compare_percent_out_by_project>0) {
                    echo number_format($compare_percent_out_by_project, 2)."%";
                } else {
                    echo "-";
                }
            } else {
                echo "-";
            } ?>
                </td>
                <td class="text-right">
                    <?php
            if ($sumptotalrojectplan_by_project>0) {
                $compare_percent_total_by_project=($sumtotal_project_6_all_by_project/$sumptotalrojectplan_by_project)*100;
                if ($compare_percent_total_by_project>0) {
                    echo number_format($compare_percent_total_by_project, 2)."%";
                } else {
                    echo "-";
                }
            }else {
                echo "-";
            }
             ?>
                </td>
                <td>&nbsp;</td>
            </tr>
            <?php
    }
    }
    }
    ?>
        </table>
    </div>
</div>