<?php
use app\models\GroupProjectType;
use app\models\Project;
use app\models\ProjectPayment;
use app\models\ProjectProgression;
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
                <td colspan="22" align="right"><b><?=Yii::t('app','ຫົວ​ໜ່ວຍ:ລ້ານ​ກີບ')?></b></td>
            </tr>
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
                    <?=Yii::t('app', 'ລວມປະເພດໂຄງການລົງທຶນຂອງລັດ')?></td>
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
                $sumtotalgroupproject_6_in=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
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
                ->where(['project_year'=>$year-1])
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
                } else {
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
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <!------------------ ໂຄງການລົງທຶນຂອງລັດລະດັບຊາດ --------------------------------------------->
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><?=Yii::t('app', 'ໂຄງການລົງທຶນຂອງລັດລະດັບຊາດ')?></td>
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
                <td><?=Yii::t('app', 'ໂຄງການລົງທຶນຂອງລັດປົກະຕິ')?></td>
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
                <td>
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
                $sumtotalgroupproject_6_in=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
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
                ->where(['project_year'=>$year-1])
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
                } else {
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
                $sumoutgroupproject_6_in=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
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
                ->where(['project_year'=>$year-1])
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
                $sumoutgroupproject_12_in=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
                ->andWhere(['between','approved_govt_budget',$groupproject->min_amount,$groupproject->max_amount])
               // ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>0])
                ->sum('amount');
        if ($sumoutgroupproject_12_in>0) {
            echo number_format($sumoutgroupproject_12_in, 2);
        } else {
            echo "-";
        } ?>
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
        } else {
            echo "-";
        } ?>
                </td>
                <td class="text-right">
                    <?php
            $sumpoject_12=$sumoutgroupproject_12_in+$sumoutgroupproject_12_out;
        if ($sumpoject_12>0) {
            echo number_format($sumpoject_12, 2);
        } else {
            echo "-";
        } ?>
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
                <td class="text-center" style=" white-space:nowrap !important;"><?=Yii::t('app', 'ລວມ​ທືນ​ທັງ​ໝົດ')?>
                </td>
                <td class="text-center">
                    <?php
                $count_total_project_by_status=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
              //  ->andWhere(['project_status_id'=>$projectstatus->id])
                ->count();
                if ($count_total_project_by_status>0) {
                    echo $count_total_project_by_status;
                } else {
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
                    echo number_format($sum_total_project_by_status_in, 2);
                } else {
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
                    echo number_format($sum_total_project_by_status_oda, 2);
                } else {
                    echo "-";
                }
            ?>
                </td>
                <td class="text-right">
                    <?php
            $sum_total_all_project_status=$sum_total_project_by_status_in+$sum_total_project_by_status_oda;
            if ($sum_total_all_project_status>0) {
                echo number_format($sum_total_all_project_status, 2);
            } else {
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
                } else {
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
                } else {
                    echo "-";
                }
            ?>
                </td>
                <td class="text-right">
                    <?php
            $sum_paid_total_all_project_status=$sum__total_paid_project_by_satatus+$sum_total_paid_project_by_satatus_oda;
            if ($sum_paid_total_all_project_status>0) {
                echo number_format($sum_paid_total_all_project_status, 2);
            } else {
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
                    } else {
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
                    } else {
                        echo "-";
                    }
                ?>
                </td>
                <td class="text-right">
                    <?php
            $sum_paid_total_all_project_status_12=$sum__total_paid_project_by_satatus_12+$sum_total_paid_project_by_satatus_oda_12;
            if ($sum_paid_total_all_project_status_12>0) {
                echo number_format($sum_paid_total_all_project_status_12, 2);
            } else {
                echo "-";
            }
            ?>
                </td>
                <td class="text-right">
                    <?php
                $sum__all_projectplan_by_status=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
               // ->andWhere(['project_status_id'=>$projectstatus->id])
               ->sum('aproved_amount');
                if ($sum__all_projectplan_by_status>0) {
                    echo number_format($sum__all_projectplan_by_status, 2);
                } else {
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
                    } else {
                        echo "-";
                    }
                ?>
                </td>
                <td class="text-right">
                    <?php
            $sum__total_all_projectplan_by_status=$sum__all_projectplan_by_status+$sum_all_projectplan_by_status_oda;
            if ($sum__total_all_projectplan_by_status>0) {
                echo number_format($sum__total_all_projectplan_by_status, 2);
            } else {
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
                <td><?=Yii::t('app', 'ທ​ືນ​ໂຄງ​ການ ODA')?></td>
                <td>
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
                $sum_paid_project_by_satatus_oda=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
               // ->andWhere(['project_status_id'=>$projectstatus->id])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>1])
                ->sum('amount');
                if ($sum_paid_project_by_satatus_oda>0) {
                    echo number_format($sum_paid_project_by_satatus_oda, 2);
                } else {
                    echo "-";
                }
            ?>
                </td>
                <td class="text-right">
                    <?php
                if ($sum_paid_project_by_satatus_oda>0) {
                    echo number_format($sum_paid_project_by_satatus_oda, 2);
                } else {
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
                } else {
                    echo "-";
                }
            ?>
                </td>
                <td class="text-right">
                    <?php
                if ($sum_paid_project_by_satatus_oda_12>0) {
                    echo number_format($sum_paid_project_by_satatus_oda_12, 2);
                } else {
                    echo "-";
                }
            ?>
                </td>
                <td class="text-right">-</td>
                <td class="text-right">
                    <?php
                    $sum_projectplan_by_status_oda=ProjectProgression::find()
                    ->joinWith(['project'])
                    ->where(['project_year'=>$year])
                ->sum('aproved_amount_oda');
                    if ($sum_projectplan_by_status_oda>0) {
                        echo number_format($sum_projectplan_by_status_oda, 2);
                    } else {
                        echo "-";
                    }
                ?>
                </td>
                <td class="text-right">
                    <?php
                if ($sum_projectplan_by_status_oda>0) {
                    echo number_format($sum_projectplan_by_status_oda, 2);
                } else {
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
                </td>
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
                $sum_paid_project_by_satatus=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
                ->andWhere(['project_status_id'=>$projectstatus->id])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>0])
                ->sum('amount');
            if ($sum_paid_project_by_satatus>0) {
                echo number_format($sum_paid_project_by_satatus, 2);
            } else {
                echo "-";
            } ?>
                </td>
                <td class="text-right">-</td>
                <td class="text-right">
                    <?php
                if ($sum_paid_project_by_satatus>0) {
                    echo number_format($sum_paid_project_by_satatus, 2);
                } else {
                    echo "-";
                } ?>
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
            } else {
                echo "-";
            } ?>
                </td>
                <td class="text-right">-</td>
                <td class="text-right">
                    <?php
                if ($sum_paid_project_by_satatus_12>0) {
                    echo number_format($sum_paid_project_by_satatus_12, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td class="text-right">
                    <?php
                $sum_projectplan_by_status=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['project_status_id'=>$projectstatus->id])
               ->sum('aproved_amount');
            if ($sum_projectplan_by_status>0) {
                echo number_format($sum_projectplan_by_status, 2);
            } else {
                echo "-";
            } ?>
                </td>
                <td class="text-right">-</td>
                <td class="text-right">
                    <?php
                if ($sum_projectplan_by_status>0) {
                    echo number_format($sum_projectplan_by_status, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <?php
        }
    ?>
            <!---------------------- ລວມ​ປະ​ເພດ​ການ​ລົງທືນ​ຂອງ​ລັດ -------------------------------------------->
            <tr>
                <td>III</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td class="text-center" style=" white-space:nowrap !important;">
                    <?=Yii::t('app', 'ລວມ​ປະ​ເພດ​ການ​ລົງທືນ​ຂອງ​ລັດ')?></td>
                <td>
                    <?php
                $count_total_project_by_status=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
              //  ->andWhere(['project_status_id'=>$projectstatus->id])
                ->count();
                if ($count_total_project_by_status>0) {
                    echo $count_total_project_by_status;
                } else {
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
                    echo number_format($sum_total_project_by_status_in, 2);
                } else {
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
                    echo number_format($sum_total_project_by_status_oda, 2);
                } else {
                    echo "-";
                }
            ?>
                </td>
                <td class="text-right">
                    <?php
            $sum_total_all_project_status=$sum_total_project_by_status_in+$sum_total_project_by_status_oda;
            if ($sum_total_all_project_status>0) {
                echo number_format($sum_total_all_project_status, 2);
            } else {
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
                } else {
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
                } else {
                    echo "-";
                }
            ?>
                </td>
                <td class="text-right">
                    <?php
            $sum_paid_total_all_project_status=$sum__total_paid_project_by_satatus+$sum_total_paid_project_by_satatus_oda;
            if ($sum_paid_total_all_project_status>0) {
                echo number_format($sum_paid_total_all_project_status, 2);
            } else {
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
                    } else {
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
                    } else {
                        echo "-";
                    }
                ?>
                </td>
                <td class="text-right">
                    <?php
            $sum_paid_total_all_project_status_12=$sum__total_paid_project_by_satatus_12+$sum_total_paid_project_by_satatus_oda_12;
            if ($sum_paid_total_all_project_status_12>0) {
                echo number_format($sum_paid_total_all_project_status_12, 2);
            } else {
                echo "-";
            }
            ?>
                </td>
                <td class="text-right">
                    <?php
                $sum__all_projectplan_by_status=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
               // ->andWhere(['project_status_id'=>$projectstatus->id])
               ->sum('aproved_amount');
                if ($sum__all_projectplan_by_status>0) {
                    echo number_format($sum__all_projectplan_by_status, 2);
                } else {
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
                    } else {
                        echo "-";
                    }
                ?>
                </td>
                <td class="text-right">
                    <?php
            $sum__total_all_projectplan_by_status=$sum__all_projectplan_by_status+$sum_all_projectplan_by_status_oda;
            if ($sum__total_all_projectplan_by_status>0) {
                echo number_format($sum__total_all_projectplan_by_status, 2);
            } else {
                echo "-";
            }
            ?>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>

            <!---------------------- List Project type ------------------------------------------>
            <?php
            $projecttypes=ProjectType::find()->all();
            $s='';
            foreach ($projecttypes as $projecttype) {
                $s='i'.$s;
                ?>
            <tr class="bg-info">
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td class="text-center" style=" white-space:nowrap !important;"><?=$projecttype->project_type?></td>
                <td>
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
                $sum__total_paid_project_by_satatus=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
                ->andWhere(['project_type_id'=>$projecttype->id])
               // ->andWhere(['project_status_id'=>$projectstatus->id])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>0])
                ->sum('amount');
                if ($sum__total_paid_project_by_satatus>0) {
                    echo number_format($sum__total_paid_project_by_satatus, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td class="text-right">
                    <?php
                $sum_total_paid_project_by_satatus_oda=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
                ->andWhere(['project_type_id'=>$projecttype->id])
               // ->andWhere(['project_status_id'=>$projectstatus->id])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>1])
                ->sum('amount');
                if ($sum_total_paid_project_by_satatus_oda>0) {
                    echo number_format($sum_total_paid_project_by_satatus_oda, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td class="text-right">
                    <?php
            $sum_paid_total_all_project_status=$sum__total_paid_project_by_satatus+$sum_total_paid_project_by_satatus_oda;
                if ($sum_paid_total_all_project_status>0) {
                    echo number_format($sum_paid_total_all_project_status, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td class="text-right">
                    <?php
                    $sum__total_paid_project_by_satatus_12=ProjectPayment::find()
                    ->joinWith(['projectProgression','projectProgression.project'])
                    ->where(['project_year'=>$year-1])
                    ->andWhere(['project_type_id'=>$projecttype->id])
                    // ->andWhere(['project_status_id'=>$projectstatus->id])
                    //  ->andWhere(['payment_type'=>'first_six_months'])
                    ->andWhere(['project_payment.is_oda'=>0])
                    ->sum('amount');
                if ($sum__total_paid_project_by_satatus_12>0) {
                    echo number_format($sum__total_paid_project_by_satatus_12, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td class="text-right">
                    <?php
                    $sum_total_paid_project_by_satatus_oda_12=ProjectPayment::find()
                    ->joinWith(['projectProgression','projectProgression.project'])
                    ->where(['project_year'=>$year-1])
                    ->andWhere(['project_type_id'=>$projecttype->id])
                    // ->andWhere(['project_status_id'=>$projectstatus->id])
                   // ->andWhere(['payment_type'=>'first_six_months'])
                    ->andWhere(['project_payment.is_oda'=>1])
                    ->sum('amount');
                if ($sum_total_paid_project_by_satatus_oda_12>0) {
                    echo number_format($sum_total_paid_project_by_satatus_oda_12, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td class="text-right">
                    <?php
            $sum_paid_total_all_project_status_12=$sum__total_paid_project_by_satatus_12+$sum_total_paid_project_by_satatus_oda_12;
                if ($sum_paid_total_all_project_status_12>0) {
                    echo number_format($sum_paid_total_all_project_status_12, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td class="text-right">
                    <?php
                $sum__all_projectplan_by_status=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
               // ->andWhere(['project_status_id'=>$projectstatus->id])
               ->sum('aproved_amount');
                if ($sum__all_projectplan_by_status>0) {
                    echo number_format($sum__all_projectplan_by_status, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td class="text-right">
                    <?php
                    $sum_all_projectplan_by_status_oda=ProjectProgression::find()
                    ->joinWith(['project'])
                    ->where(['project_year'=>$year])
                    ->andWhere(['project_type_id'=>$projecttype->id])
                ->sum('aproved_amount_oda');
                if ($sum_all_projectplan_by_status_oda>0) {
                    echo number_format($sum_all_projectplan_by_status_oda, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td class="text-right">
                    <?php
            $sum__total_all_projectplan_by_status=$sum__all_projectplan_by_status+$sum_all_projectplan_by_status_oda;
                if ($sum__total_all_projectplan_by_status>0) {
                    echo number_format($sum__total_all_projectplan_by_status, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <!------------------------- ທ​ືນ​ໂຄງ​ການ ODA By Projrct type --------------------------------------------------->
            <tr>
                <td><?=$s.'1'?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><?=Yii::t('app', 'ທ​ືນ​ໂຄງ​ການ ODA')?></td>
                <td class="text-center">
                    <?php
                $count_total_project_by_status_oda=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['project_type_id'=>$projecttype->id])
                ->andWhere(['is_oda'=>1])
                ->count();
                if ($count_total_project_by_status_oda>0) {
                    echo $count_total_project_by_status_oda;
                } else {
                    echo "-";
                } ?>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td class="text-right">-</td>
                <td class="text-right">
                    <?php
                $sum_project_by_status_oda=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['project_type_id'=>$projecttype->id])
                ->andWhere(['is_oda'=>1])
                ->sum('oda_budget');
                if ($sum_project_by_status_oda>0) {
                    echo number_format($sum_project_by_status_oda, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td class="text-right">
                    <?php
                    if ($sum_project_by_status_oda>0) {
                        echo number_format($sum_project_by_status_oda, 2);
                    } else {
                        echo "-";
                    } ?>
                </td>
                <td class="text-right">-</td>
                <td class="text-right">
                    <?php
                $sum_paid_project_by_satatus_oda=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
               // ->andWhere(['project_status_id'=>$projectstatus->id])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_type_id'=>$projecttype->id])
                ->andWhere(['project_payment.is_oda'=>1])
                ->sum('amount');
                if ($sum_paid_project_by_satatus_oda>0) {
                    echo number_format($sum_paid_project_by_satatus_oda, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td class="text-right">
                    <?php
                if ($sum_paid_project_by_satatus_oda>0) {
                    echo number_format($sum_paid_project_by_satatus_oda, 2);
                } else {
                    echo "-";
                } ?>
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
                ->andWhere(['project_type_id'=>$projecttype->id])
                ->sum('amount');
                if ($sum_paid_project_by_satatus_oda_12>0) {
                    echo number_format($sum_paid_project_by_satatus_oda_12, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td class="text-right">
                    <?php
                if ($sum_paid_project_by_satatus_oda_12>0) {
                    echo number_format($sum_paid_project_by_satatus_oda_12, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td class="text-right">-</td>
                <td class="text-right">
                    <?php
                    $sum_projectplan_by_status_oda=ProjectProgression::find()
                    ->joinWith(['project'])
                    ->where(['project_year'=>$year])
                    ->andWhere(['project_type_id'=>$projecttype->id])
                ->sum('aproved_amount_oda');
                if ($sum_projectplan_by_status_oda>0) {
                    echo number_format($sum_projectplan_by_status_oda, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td class="text-right">
                    <?php
                if ($sum_projectplan_by_status_oda>0) {
                    echo number_format($sum_projectplan_by_status_oda, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <!--------------------- foreeach Project status by project type -------------------------->
            <?php
        $projectstatuss=ProjectStatus::find()->orderBy('id asc')->all();
                $i=1;
                foreach ($projectstatuss as $key=>$projectstatus) {
                    $i++; ?>
            <tr>
                <td><?=$s.$i?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><?=$projectstatus->project_status?></td>
                <td class="text-center">
                    <?php
                $count_project_by_status=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['project_type_id'=>$projecttype->id])
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
                ->andWhere(['project_type_id'=>$projecttype->id])
                ->andWhere(['project_status_id'=>$projectstatus->id])
                ->sum('approved_govt_budget');
                    if ($sum_project_by_status_in>0) {
                        echo number_format($sum_project_by_status_in, 2);
                    } else {
                        echo "-";
                    } ?>
                </td>
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
                $sum_paid_project_by_satatus=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
                ->andWhere(['project_status_id'=>$projectstatus->id])
                ->andWhere(['project_type_id'=>$projecttype->id])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>0])
                ->sum('amount');
                    if ($sum_paid_project_by_satatus>0) {
                        echo number_format($sum_paid_project_by_satatus, 2);
                    } else {
                        echo "-";
                    } ?>
                </td>
                <td class="text-right">-</td>
                <td class="text-right">
                    <?php
                if ($sum_paid_project_by_satatus>0) {
                    echo number_format($sum_paid_project_by_satatus, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td class="text-right">
                    <?php
                $sum_paid_project_by_satatus_12=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
                ->andWhere(['project_status_id'=>$projectstatus->id])
                ->andWhere(['project_type_id'=>$projecttype->id])
               // ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>0])
                ->sum('amount');
                    if ($sum_paid_project_by_satatus_12>0) {
                        echo number_format($sum_paid_project_by_satatus_12, 2);
                    } else {
                        echo "-";
                    } ?>
                </td>
                <td class="text-right">-</td>
                <td class="text-right">
                    <?php
                if ($sum_paid_project_by_satatus_12>0) {
                    echo number_format($sum_paid_project_by_satatus_12, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td class="text-right">
                    <?php
                $sum_projectplan_by_status=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['project_status_id'=>$projectstatus->id])
                ->andWhere(['project_type_id'=>$projecttype->id])
               ->sum('aproved_amount');
                    if ($sum_projectplan_by_status>0) {
                        echo number_format($sum_projectplan_by_status, 2);
                    } else {
                        echo "-";
                    } ?>
                </td>
                <td class="text-right">-</td>
                <td class="text-right">
                    <?php
                if ($sum_projectplan_by_status>0) {
                    echo number_format($sum_projectplan_by_status, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <?php
                }
            }
    ?>
            <!-------------------------------- Project Details  List ---------------------->
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td class="text-center"><?=Yii::t('app','ລາຍ​ລະ​ອຽດ')?></td>
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
            <!---------------------- List Project type and details ------------------------------------------>
            <?php
            $projecttypes=ProjectType::find()->all();
            $s='';
            foreach ($projecttypes as $projecttype) {
                $s='i'.$s;
                ?>
            <tr class="bg-info">
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td class="text-center" style=" white-space:nowrap !important;"><?=$projecttype->project_type?></td>
                <td>
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
                $sum__total_paid_project_by_satatus=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
                ->andWhere(['project_type_id'=>$projecttype->id])
               // ->andWhere(['project_status_id'=>$projectstatus->id])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>0])
                ->sum('amount');
                if ($sum__total_paid_project_by_satatus>0) {
                    echo number_format($sum__total_paid_project_by_satatus, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td class="text-right">
                    <?php
                $sum_total_paid_project_by_satatus_oda=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
                ->andWhere(['project_type_id'=>$projecttype->id])
               // ->andWhere(['project_status_id'=>$projectstatus->id])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>1])
                ->sum('amount');
                if ($sum_total_paid_project_by_satatus_oda>0) {
                    echo number_format($sum_total_paid_project_by_satatus_oda, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td class="text-right">
                    <?php
            $sum_paid_total_all_project_status=$sum__total_paid_project_by_satatus+$sum_total_paid_project_by_satatus_oda;
                if ($sum_paid_total_all_project_status>0) {
                    echo number_format($sum_paid_total_all_project_status, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td class="text-right">
                    <?php
                    $sum__total_paid_project_by_satatus_12=ProjectPayment::find()
                    ->joinWith(['projectProgression','projectProgression.project'])
                    ->where(['project_year'=>$year-1])
                    ->andWhere(['project_type_id'=>$projecttype->id])
                    // ->andWhere(['project_status_id'=>$projectstatus->id])
                    //  ->andWhere(['payment_type'=>'first_six_months'])
                    ->andWhere(['project_payment.is_oda'=>0])
                    ->sum('amount');
                if ($sum__total_paid_project_by_satatus_12>0) {
                    echo number_format($sum__total_paid_project_by_satatus_12, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td class="text-right">
                    <?php
                    $sum_total_paid_project_by_satatus_oda_12=ProjectPayment::find()
                    ->joinWith(['projectProgression','projectProgression.project'])
                    ->where(['project_year'=>$year-1])
                    ->andWhere(['project_type_id'=>$projecttype->id])
                    // ->andWhere(['project_status_id'=>$projectstatus->id])
                   // ->andWhere(['payment_type'=>'first_six_months'])
                    ->andWhere(['project_payment.is_oda'=>1])
                    ->sum('amount');
                if ($sum_total_paid_project_by_satatus_oda_12>0) {
                    echo number_format($sum_total_paid_project_by_satatus_oda_12, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td class="text-right">
                    <?php
            $sum_paid_total_all_project_status_12=$sum__total_paid_project_by_satatus_12+$sum_total_paid_project_by_satatus_oda_12;
                if ($sum_paid_total_all_project_status_12>0) {
                    echo number_format($sum_paid_total_all_project_status_12, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td class="text-right">
                    <?php
                $sum__all_projectplan_by_status=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
               // ->andWhere(['project_status_id'=>$projectstatus->id])
               ->sum('aproved_amount');
                if ($sum__all_projectplan_by_status>0) {
                    echo number_format($sum__all_projectplan_by_status, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td class="text-right">
                    <?php
                    $sum_all_projectplan_by_status_oda=ProjectProgression::find()
                    ->joinWith(['project'])
                    ->where(['project_year'=>$year])
                    ->andWhere(['project_type_id'=>$projecttype->id])
                ->sum('aproved_amount_oda');
                if ($sum_all_projectplan_by_status_oda>0) {
                    echo number_format($sum_all_projectplan_by_status_oda, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td class="text-right">
                    <?php
            $sum__total_all_projectplan_by_status=$sum__all_projectplan_by_status+$sum_all_projectplan_by_status_oda;
                if ($sum__total_all_projectplan_by_status>0) {
                    echo number_format($sum__total_all_projectplan_by_status, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>

            <!--------------------- foreeach Project status by project type  and details -------------------------->
            <?php
        $projectstatuss=ProjectStatus::find()->orderBy('id asc')->all();
                $i=1;
                foreach ($projectstatuss as $key=>$projectstatus) {
                    $i++; ?>
            <tr>
                <td><?=$s.$i?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><?=$projectstatus->project_status?></td>
                <td class="text-center">
                    <?php
                $count_project_by_status=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['project_type_id'=>$projecttype->id])
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
                ->andWhere(['project_type_id'=>$projecttype->id])
                ->andWhere(['project_status_id'=>$projectstatus->id])
                ->sum('approved_govt_budget');
                    if ($sum_project_by_status_in>0) {
                        echo number_format($sum_project_by_status_in, 2);
                    } else {
                        echo "-";
                    } ?>
                </td>
                <td class="text-right">
                    <?php
                $sum_project_by_status_out=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['project_type_id'=>$projecttype->id])
                ->andWhere(['project_status_id'=>$projectstatus->id])
                ->sum('oda_budget');
                    if ($sum_project_by_status_out>0) {
                        echo number_format($sum_project_by_status_out, 2);
                    } else {
                        echo "-";
                    } ?>
                </td>
                <td class="text-right">
                    <?php
                $sum_project_by_status_in_out=$sum_project_by_status_in+$sum_project_by_status_out;
            if ($sum_project_by_status_in_out>0) {
                echo number_format($sum_project_by_status_in_out, 2);
            } else {
                echo "-";
            } ?>
                </td>
                <td class="text-right">
                    <?php
                $project_details_6=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['project_type_id'=>$projecttype->id])
                ->andWhere(['project_status_id'=>$projectstatus->id])
                ->all();
                $project_id_arr=[0];
                foreach($project_details_6 as $project_detail_6)
                {
                    $project_id_arr[]=$project_detail_6->project->id;
                }
                $sum_paid_project_by_satatus_6=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
               // ->andWhere(['project_status_id'=>$projectstatus->id])
                ->andWhere(['project_type_id'=>$projecttype->id])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>0])
                ->andWhere(['IN','project.id',$project_id_arr])
                ->sum('amount');
                    if ($sum_paid_project_by_satatus_6>0) {
                        echo number_format($sum_paid_project_by_satatus_6, 2);
                    } else {
                        echo "-";
                    } ?>
                </td>
                <td class="text-right">
                    <?php
                $sum_paid_project_by_satatus_oda_6=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
                // ->andWhere(['project_status_id'=>$projectstatus->id])
                ->andWhere(['project_type_id'=>$projecttype->id])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>1])
                ->andWhere(['IN','project.id',$project_id_arr])
                ->sum('amount');
                    if ($sum_paid_project_by_satatus_oda_6>0) {
                        echo number_format($sum_paid_project_by_satatus_oda_6, 2);
                    } else {
                        echo "-";
                    } 
                ?>
                </td>
                <td class="text-right">
                    <?php
                $sum_total_paid_in_out_6=$sum_paid_project_by_satatus_6+$sum_paid_project_by_satatus_oda_6;
                if ($sum_total_paid_in_out_6>0) {
                    echo number_format($sum_total_paid_in_out_6, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td class="text-right">
                    <?php
                $sum_paid_project_by_satatus_12=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
                // ->andWhere(['project_status_id'=>$projectstatus->id])
                ->andWhere(['project_type_id'=>$projecttype->id])
                //->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>0])
                ->andWhere(['IN','project.id',$project_id_arr])
                ->sum('amount');
                    if ($sum_paid_project_by_satatus_12>0) {
                        echo number_format($sum_paid_project_by_satatus_12, 2);
                    } else {
                        echo "-";
                    } 
                ?>
                </td>
                <td class="text-right">
                    <?php
                $sum_paid_project_by_satatus_oda_12=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
                // ->andWhere(['project_status_id'=>$projectstatus->id])
                ->andWhere(['project_type_id'=>$projecttype->id])
                //->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>1])
                ->andWhere(['IN','project.id',$project_id_arr])
                ->sum('amount');
                    if ($sum_paid_project_by_satatus_oda_12>0) {
                        echo number_format($sum_paid_project_by_satatus_oda_12, 2);
                    } else {
                        echo "-";
                    } 
                ?>
                </td>
                <td class="text-right">
                    <?php
                $sum_paid_project_by_satatus_in_out_12=$sum_paid_project_by_satatus_12+$sum_paid_project_by_satatus_oda_12;
                if ($sum_paid_project_by_satatus_in_out_12>0) {
                    echo number_format($sum_paid_project_by_satatus_in_out_12, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td class="text-right">
                    <?php
                $sum_projectplan_by_status=ProjectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['project_status_id'=>$projectstatus->id])
                ->andWhere(['project_type_id'=>$projecttype->id])
               ->sum('aproved_amount');
                    if ($sum_projectplan_by_status>0) {
                        echo number_format($sum_projectplan_by_status, 2);
                    } else {
                        echo "-";
                    } ?>
                </td>
                <td class="text-right">
                    <?php
                    $sum_projectplan_by_status_oda=ProjectProgression::find()
                    ->joinWith(['project'])
                    ->where(['project_year'=>$year])
                    ->andWhere(['project_status_id'=>$projectstatus->id])
                    ->andWhere(['project_type_id'=>$projecttype->id])
                ->sum('aproved_amount_oda');
                        if ($sum_projectplan_by_status_oda>0) {
                            echo number_format($sum_projectplan_by_status_oda, 2);
                        } else {
                            echo "-";
                        } ?>
                </td>
                <td class="text-right">
                    <?php
                $sum_total_plan=$sum_projectplan_by_status+$sum_projectplan_by_status_oda;
                if ($sum_total_plan>0) {
                    echo number_format($sum_total_plan, 2);
                } else {
                    echo "-";
                } ?>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <!------------------- list projects ----------------------------->
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
                $sum_paid_project_by_satatus_by_project_6=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
                //->andWhere(['project_type_id'=>$projecttype->id])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>0])
                ->andWhere(['project.id'=>$project_detail->project->id])
                ->sum('amount');
                    if ($sum_paid_project_by_satatus_by_project_6>0) {
                        echo number_format($sum_paid_project_by_satatus_by_project_6, 2);
                    } else {
                        echo "-";
                    } ?>
                </td>
                <td class="text-right">
                    <?php
                $sum_paid_project_by_satatus_by_project_oda_6=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
                //->andWhere(['project_type_id'=>$projecttype->id])
                ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>1])
                ->andWhere(['project.id'=>$project_detail->project->id])
                ->sum('amount');
                    if ($sum_paid_project_by_satatus_by_project_oda_6>0) {
                        echo number_format($sum_paid_project_by_satatus_by_project_oda_6, 2);
                    } else {
                        echo "-";
                    } ?>
                </td>
                <td class="text-right">
                    <?php
            $sum_total_paid_in_out_6=$sum_paid_project_by_satatus_by_project_6+$sum_paid_project_by_satatus_by_project_oda_6;
            if($sum_total_paid_in_out_6>0)
            {
                echo number_format($sum_total_paid_in_out_6, 2);
            }else{
                echo "-";
            }
            ?>
                </td>
                <td class="text-right">
                    <?php
                $sum_paid_project_by_satatus_by_project_12=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
                //->andWhere(['project_type_id'=>$projecttype->id])
               // ->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>0])
                ->andWhere(['project.id'=>$project_detail->project->id])
                ->sum('amount');
                    if ($sum_paid_project_by_satatus_by_project_12>0) {
                        echo number_format($sum_paid_project_by_satatus_by_project_12, 2);
                    } else {
                        echo "-";
                    } ?>
                </td>
                <td class="text-right">
                    <?php
                $sum_paid_project_by_satatus_by_project_oda_12=ProjectPayment::find()
                ->joinWith(['projectProgression','projectProgression.project'])
                ->where(['project_year'=>$year-1])
                //->andWhere(['project_type_id'=>$projecttype->id])
                //->andWhere(['payment_type'=>'first_six_months'])
                ->andWhere(['project_payment.is_oda'=>1])
                ->andWhere(['project.id'=>$project_detail->project->id])
                ->sum('amount');
                    if ($sum_paid_project_by_satatus_by_project_oda_12>0) {
                        echo number_format($sum_paid_project_by_satatus_by_project_oda_12, 2);
                    } else {
                        echo "-";
                    } ?>
                </td>
                <td class="text-right">
                    <?php
                $sum_total_paid_in_out_12=$sum_paid_project_by_satatus_by_project_12+$sum_paid_project_by_satatus_by_project_oda_12;
                if($sum_total_paid_in_out_12>0)
                {
                    echo number_format($sum_total_paid_in_out_12, 2);
                }else{
                    echo "-";
                }
            ?>
                </td>
                <td class="text-right">
                    <?php
                $sum_plan_in=projectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['project.id'=>$project_detail->project->id])
                ->sum('aproved_amount');
                    if ($sum_plan_in>0) {
                        echo number_format($sum_plan_in, 2);
                    } else {
                        echo "-";
                    } ?>
                </td>
                <td class="text-right">
                    <?php
                $sum_plan_oda=projectProgression::find()
                ->joinWith(['project'])
                ->where(['project_year'=>$year])
                ->andWhere(['project.id'=>$project_detail->project->id])
                ->sum('aproved_amount_oda');
                    if ($sum_plan_oda>0) {
                        echo number_format($sum_plan_oda, 2);
                    } else {
                        echo "-";
                    } ?>
                </td>
                <td class="text-right">
                    <?php
                $sum_plan_in_out=$sum_plan_in+$sum_plan_oda;
                if($sum_plan_in_out>0)
                {
                    echo number_format($sum_plan_in_out, 2);
                }else{
                    echo "-";
                }
            ?>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            <tr>
                <?php
            }
                }
            }
    ?>
        </table>
    </div>
</div>