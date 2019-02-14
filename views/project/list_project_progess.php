<?php
use app\models\ProjectStatus;
use app\models\ProjectPayment;
?>
<div class="row">
    <div class="col-md-12">
        <div class="contacts table-responsive">
            <label >
<?=Yii::t('app', 'ລາຍ​ການແຜ່ນ​ແລະ​ການ​ສຳ​ລະ/ລ້ານ​ກີບ')?></label>
            <table class="table table-bordered table-dark tab-content">
                <tr style="background:#eff5f5">
                    <th><?=Yii::t('app', 'ປີ')?></th>
                    <th><?=Yii::t('app', '​ສະ​ຖາ​ນະ')?></th>
                    <th><?=Yii::t('app', 'ຈໍານວນ​ເງີນສະເຫນີ')?></th>
                    <th><?=Yii::t('app', 'ຈໍານວນເງິນອະນຸມັດ')?></th>
                    <th><?=Yii::t('app', 'ມູນ​ຄ່າ​​ຊຳລະ​ 6 ຕົ້ນ​ປີ')?></th>
                    <th><?=Yii::t('app', 'ມູນ​ຄ່າ​ຊຳລະ​ 6 ທ້າຍ​​ປີ')?></th>
                    <td align="right">
                        <?php
                        echo yii\helpers\Html::a("<il class='glyphicon glyphicon-plus-sign'></il>", '#', [
                            'onclick' => "
                                    $.ajax({
                                    type     :'GET',
                                    cache    : false,
                                    url  : 'index.php?r=project/projectprocesscreate',
                                    success  : function(response) {
                                    $('#project_progess').html(response);
                                    }
                                    });return false;",
                            'class'=>'btn btn-success btn-sm ls-modal',
                           // 'id'=>'jobPop'
                        ]);
                        ?>
                    </td>
                </tr>
                <?php
                if (!empty(Yii::$app->session['project_progress'])) {
                    $list=Yii::$app->session['project_progress'];
                        ?>
                <tr>
                    <td><?=$list->project_year?></td>
                    <td><?=ProjectStatus::find()->where(['id'=>$list->project_status_id])->one()->project_status?></td>
                    <td><?=number_format($list->proposal_amount,2)?></td>
                    <td><?=number_format($list->aproved_amount,2)?></td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td align="right">
                    <?php
                        echo yii\helpers\Html::a("<il class='glyphicon glyphicon-edit'></il>", '#', [
                            'onclick' => "
                                    $.ajax({
                                    type     :'GET',
                                    cache    : false,
                                    url  : 'index.php?r=project/projectprocesscreate',
                                    success  : function(response) {
                                    $('#project_progess').html(response);
                                    }
                                    });return false;",
                            'class'=>'btn btn-success btn-xs ls-modal',
                           // 'id'=>'jobPop'
                        ]);
                        echo " ";
                            echo yii\helpers\Html::a("<il class=' glyphicon glyphicon-remove-circle' ></il>", '#', [
                            //  'confirm' => Yii::t('models', 'Are you sure you want to delete this item?'),
                                'onclick' => "
                                    if (confirm('".Yii::t('app','ທ່ານ​ຕ້ອງ​ການ​ລຶບ​ລາຍ​ການນີ້ບໍ່.?')."')) {
                                            $.ajax({
                                            type     :'GET',
                                            cache    : false,
                                            url  : 'index.php?r=project/delprojectprogress&dels=session',
                                            data: {
                                                id:'',
                                                project_id:''                                               
                                            },
                                            success  : function(response) {
                                            $('#list_pt').html(response);
                                            }
                                            });return false;
                                    }",
                            // 'style' => "color:red;",
                                'class'=>'btn btn-danger btn-xs'
                            ]);
                        ?>
                    </td>
                </tr>
                <?php
                }
                if(!empty(\Yii::$app->session['project_progress_save']))
                {
                    foreach(\Yii::$app->session['project_progress_save'] as $list)
                    {
                        ?>
                        <tr>
                            <td><?=$list->project_year?></td>
                            <td><?=ProjectStatus::find()->where(['id'=>$list->project_status_id])->one()->project_status?></td>
                            <td><?=$list->proposal_amount?></td>
                            <td><?=$list->aproved_amount?></td>
                            <td>
                            <?php
                                 $model=ProjectPayment::find()->where(['project_progression_id'=>$list->id,'payment_type'=>'first_six_months'])->one();
                                if(!empty($model) && $model->amount>0)
                                {
                                    $link_6=$model->amount;
                                }else{
                                    $link_6="​ຊຳລະ​ເງີນ";
                                }
                                 echo yii\helpers\Html::a($link_6, '#', [
                                    'onclick' => "
                                            $.ajax({
                                            type     :'GET',
                                            cache    : false,
                                            url  : 'index.php?r=project/projectpay&timespay=1&progress_id=".$list->id."',
                                            success  : function(response) {
                                            $('#project_progess').html(response);
                                            }
                                            });return false;",
                                    'class'=>'btn btn-link btn-xs ls-modal',
                                   // 'id'=>'jobPop'
                                ]); 
                            ?>
                            </td>
                            <td>
                            <?php
                                 $model=ProjectPayment::find()->where(['project_progression_id'=>$list->id,'payment_type'=>'full_year'])->one();
                                 if(!empty($model) && $model->amount>0)
                                 {
                                     $link_12=$model->amount;
                                 }else{
                                     $link_12="​ຊຳ​ລະ​ເງີນ";
                                 }
                                echo yii\helpers\Html::a($link_12, '#', [
                                    'onclick' => "
                                            $.ajax({
                                            type     :'GET',
                                            cache    : false,
                                            url  : 'index.php?r=project/projectpay&timespay=2&progress_id=".$list->id."',
                                            success  : function(response) {
                                            $('#project_progess').html(response);
                                            }
                                            });return false;",
                                    'class'=>'btn btn-link btn-xs ls-modal',
                                   // 'id'=>'jobPop'
                                ]); 
                            ?>
                            </td>
                            <td align="right" class="">
                            <?php
                            echo yii\helpers\Html::a("<il class=' glyphicon glyphicon-edit' ></il>", '#', [
                                'onclick' => "
                                        $.ajax({
                                        type     :'GET',
                                        cache    : false,
                                        url  : 'index.php?r=project/projectprocesscreate&project_id=".$list->project_id."&progress_id=".$list->id."',
                                        success  : function(response) {
                                        $('#project_progess').html(response);
                                        }
                                        });return false;",
                                'class'=>'btn btn-primary btn-xs ls-modal',
                               // 'id'=>'jobPop'
                            ]); 
                            echo " ";
                            echo yii\helpers\Html::a("<il class=' glyphicon glyphicon-remove-circle' ></il>", '#', [
                            //  'confirm' => Yii::t('models', 'Are you sure you want to delete this item?'),
                                'onclick' => "
                                    if (confirm('".Yii::t('app','ທ່ານ​ຕ້ອງ​ການ​ລຶບ​ລາຍ​ການນີ້ບໍ່.?')."')) {
                                            $.ajax({
                                            type     :'GET',
                                            cache    : false,
                                            url  : 'index.php?r=project/delprojectprogress',
                                            data: {
                                                id:'".$list->id."',
                                                project_id:'".Yii::$app->session['project_id']."'                                               
                                            },
                                            success  : function(response) {
                                            $('#list_pt').html(response);
                                            }
                                            });return false;
                                    }",
                            // 'style' => "color:red;",
                                'class'=>'btn btn-danger btn-xs'
                            ]);
                             ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>
</div>
<div id="project_progess"></div>