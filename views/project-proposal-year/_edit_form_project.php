<?php
$script = <<< JS
    $("#modal").modal("show");
    $(".close_modal").click(function () {
    $(".modal").modal("hide");
});
JS;
$this->registerJs($script);
?>
    <div class="modal " id="modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?=Yii::t('app','ແກ້​ໄຂບົດ​ສະ​ເໜີ​ໂຄງ​ການ')?></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <label><?=$model->getAttributeLabel('project_name')?></label>
                    <input value="<?=$model->project_name?>" type="text" id="project_name_e" class="form-control" name="ProjectProposal['project_name'][]" autocomplete="off">
                </div>

                <div class="col-md-12">
                    <label><?=$model->getAttributeLabel('code_old_project')?></label>
                    <select name="ProjectProposal['code_old_project'][]" id="code_old_project_e" class="form-control">
                        <option ></option>
                            <option value="​ສືບ​ຕໍ່">ສືບ​ຕໍ່</option>
                            <option value="ໃໝ່">ໃໝ່</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <label><?=$model->getAttributeLabel('start_year')?></label>
                    <input value="<?=$model->start_year?>"  type="number" placeholder="YYYY" min="2017" max="2100" step="1" name="ProjectProposal['start_year'][]" id="start_year_e" class="form-control" autocomplete="off">   
                    <script>
                    document.querySelector("input[type=number]").oninput = e => console.log(new Date(e.target.valueAsNumber, 0, 1))
                    </script>
                </div>

                <div class="col-md-12">
                    <label><?=$model->getAttributeLabel('end_year')?></label>
                    <input value="<?=$model->end_year?>" type="number" placeholder="YYYY" min="2017" max="2100" step="1"  type="text" name="ProjectProposal['end_year'][]" id="end_year_e" class="form-control" autocomplete="off">
                </div>
                <div class="col-md-12">
                    <label><?=$model->getAttributeLabel('amount')?></label>
                    <input value="<?=number_format($model->amount,2)?>" type="text" name="ProjectProposal['amount'][]" id="amount_e" class="form-control money_format" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <?php
                echo yii\helpers\Html::a("ແກ້​ໄຂ", '#', [
                    'onclick' => "
                            $.ajax({
                            type     :'POST',
                            cache    : false,
                            url  : 'index.php?r=project-proposal-year/editprojects&id=".$key."&modal=0',
                            data: {
                                project_name: $('#project_name_e').val(),
                                start_year: $('#start_year_e').val(),
                                end_year: $('#end_year_e').val(),
                                amount: $('#amount_e').val(),
                                code_old_project: $('#code_old_project_e').val(),
                            },
                            success  : function(response) {
                            $('#list_pt').html(response);
                            }
                            });return false;",
                    'class'=>'btn btn-success btn-sm close_modal',
                ]);
            ?>
        </div>
      </div>
      
    </div>
  </div>