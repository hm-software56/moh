<?php
use kartik\select2\Select2;
use yii\helpers\Html;
?>
<div class="row">
    <div class="col-md-12">
        <div class="contacts table-responsive">
            <label><?=Yii::t('app','ລາຍ​ການໂຄງ​ການ​ທັງ​ໝົດ')?></label>
            <table class="table tab-content">
                <tr style="background:#eff5f5">
                    <td></td>
                    <th><?=Yii::t('app','ຊື່​​ໂຄງ​ການ')?></th>
                    <th><?=Yii::t('app','​ປີ​ເລີ່ມ')?></th>
                    <th><?=Yii::t('app','​ປີ​ສີ້ນ​ສຸດ')?></th>
                    <th><?=Yii::t('app','​ຈຳ​ນວນ​ເງີນ/​ລ້ານ​ກີບ')?></th>
                    <th><?=Yii::t('app','ລະ​ຫັດ​ໂຄງ​ກາ​ນ​ສືບ​ໂຕ')?></th>
                    <th></th>
                </tr>
                <tr>
                    <td colspan="2">
                    <input type="text" id="project_name" class="form-control" name="ProjectProposal['project_name'][]" autocomplete="off">
                    </td>
                    <td style="width:100px;">
                    <input  type="number" placeholder="YYYY" min="2017" max="2100" step="1" name="ProjectProposal['start_year'][]" id="start_year" class="form-control" autocomplete="off">   
                    <script>
                    document.querySelector("input[type=number]").oninput = e => console.log(new Date(e.target.valueAsNumber, 0, 1))
                    </script>
                    </td>
                    <td style="width:100px;">
                        <input type="number" placeholder="YYYY" min="2017" max="2100" step="1"  type="text" name="ProjectProposal['end_year'][]" id="end_year" class="form-control" autocomplete="off">
                    </td>
                    <td style="width:200px;">
                        <input data-rule-required=true data-msg-required="Your message"  type="text" name="ProjectProposal['amount'][]" id="amount" class="form-control money_format" autocomplete="off">
                    </td>
                    <td style="width:150px;">
                        <input data-rule-required=true data-msg-required="Your message"  type="text" name="ProjectProposal['code_old_project'][]" id="code_old_project" class="form-control" autocomplete="off">
                    </td>
                    <td align="right">
                        <?php
                        echo yii\helpers\Html::a("+", '#', [
                            'onclick' => "
                                    $.ajax({
                                    type     :'POST',
                                    cache    : false,
                                    url  : 'index.php?r=project-proposal-year/addprojects',
                                    data: {
                                        project_name: $('#project_name').val(),
                                        start_year: $('#start_year').val(),
                                        end_year: $('#end_year').val(),
                                        amount: $('#amount').val(),
                                        code_old_project: $('#code_old_project').val(),
                                    },
                                    success  : function(response) {
                                    $('#list_pt').html(response);
                                    }
                                    });return false;",
                           /// 'style' => "color:red;",
                            'class'=>'btn btn-success btn-sm'
                        ]);
                        ?>
                    </td>
                </tr>
                
                <?php if(Yii::$app->session->hasFlash('success')):?>
                <tr>
                    <td></td>
                    <td colspan="5">
                            <div>
                               <span style="color:red"> <?php echo Yii::$app->session->getFlash('success'); ?></span>
                            </div>
                    </td>
                </tr>
                <?php endif; ?>

                <?php
                
                $tatol=0;
                    if (!empty(Yii::$app->session['model_items'])) {
                        $i=0;
                        $count=count(Yii::$app->session['model_items']);
                        foreach (Yii::$app->session['model_items'] as $key=>$model) {
                            $i++;
                            $count--;
                            $tatol+=$model->amount;
                            ?>
                <tr id="list_pt<?=$key?>">
                    <td><?=$count+1?></td>
                    <td><?=$model->project_name ?></td>
                    <td><?=$model->start_year?> </td>
                    <td><?=$model->end_year?> </td>
                    <td><?=number_format($model->amount,2)?> </td>
                    <td><?=$model->code_old_project?> </td>
                    <td align="right">
                        <?php
                        echo yii\helpers\Html::a("-", '#', [
                          //  'confirm' => Yii::t('models', 'Are you sure you want to delete this item?'),
                            'onclick' => "
                                if (confirm('".Yii::t('app','ທ່ານ​ຕ້ອງ​ການ​ລຶບ​ລາຍ​ການນີ້ບໍ່.?')."')) {
                                        $.ajax({
                                        type     :'POST',
                                        cache    : false,
                                        url  : 'index.php?r=project-proposal-year/delproject',
                                        data: {
                                            key_array:".$key.",
                                            id:'".$model->id."',
                                            
                                        },
                                        success  : function(response) {
                                        $('#list_pt".$key."').html(response);
                                        }
                                        });return false;
                                }",
                           // 'style' => "color:red;",
                            'class'=>'btn btn-danger btn-sm'
                        ]); ?>
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
