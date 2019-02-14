<?php
use app\models\ProjectStatus;
?>
<div class="row">
    <div class="col-md-12">
        <div class="contacts table-responsive">
            <label>
<?=Yii::t('app', 'ລາຍ​ການໂຄງ​ການ​ທັງ​ໝົດ')?></label>
            <table class="table table-bordered table-dark tab-content">
                <tr style="background:#eff5f5">
                    <th><?=Yii::t('app', 'ປີ')?></th>
                    <th><?=Yii::t('app', '​ສະ​ຖາ​ນະ')?></th>
                    <th><?=Yii::t('app', 'ຈໍານວນ​ເງີນສະເຫນີ/ລ້ານ​ກີບ')?></th>
                    <th><?=Yii::t('app', 'ຈໍານວນເງິນທອະນຸມັດ/ລ້ານ​ກີບ')?></th>
                    <td align="right">
                        <?php
                        if(isset($_GET['id']))
                        {
                            $id=$_GET['id'];
                        }else{
                            $id=NULL;
                        }
                        echo yii\helpers\Html::a("<il class='glyphicon glyphicon-plus-sign'></il>", '#', [
                            'onclick' => "
                                    $.ajax({
                                    type     :'GET',
                                    cache    : false,
                                    url  : 'index.php?r=project/projectprocesscreate&project_id=".$id."',
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
                            <td><?=number_format($list->proposal_amount,2)?></td>
                            <td><?=number_format($list->aproved_amount,2)?></td>
                            <td align="right" class="">
                            <?php
                            echo yii\helpers\Html::a("<il class=' glyphicon glyphicon-edit' ></il>", '#', [
                                'onclick' => "
                                        $.ajax({
                                        type     :'GET',
                                        cache    : false,
                                        url  : 'index.php?r=project/projectprocesscreate&project_id=".$id."',
                                        success  : function(response) {
                                        $('#project_progess').html(response);
                                        }
                                        });return false;",
                                'class'=>'btn btn-success btn-sm ls-modal',
                               // 'id'=>'jobPop'
                            ]); 
                            echo " ";
                            echo yii\helpers\Html::a("<il class=' glyphicon glyphicon-remove-circle' ></il>", '#', [
                                'onclick' => "
                                        $.ajax({
                                        type     :'GET',
                                        cache    : false,
                                        url  : 'index.php?r=project/projectprocesscreate&project_id=".$id."',
                                        success  : function(response) {
                                        $('#project_progess').html(response);
                                        }
                                        });return false;",
                                'class'=>'btn btn-danger btn-sm ls-modal',
                               // 'id'=>'jobPop'
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