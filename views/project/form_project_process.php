<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\ProjectType;
use app\models\ProjectStatus;

$script = <<< JS
    $("#modal").modal("show");
    $(".close_modal").click(function () {
    $(".modal").modal("hide");
});
JS;
$this->registerJs($script);
?>

<div class="u-form">
    <div class="modal " id="modal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?=Yii::t('app','​ປ້ອນ​ລາຍ​ລະ​ອຽດ')?></h4>
                </div>
                <div class="modal-body">
                    <?php $form = ActiveForm::begin(['id' => 'process-form']); ?>
                    <?= $form->field($model, 'project_year')->textInput(['maxlength' => true]) ?>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'proposal_amount')->textInput(['maxlength' => true,'class'=>"form-control money_format"]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'aproved_amount')->textInput(['maxlength' => true,'class'=>"form-control money_format"]) ?>
                        </div>
                    </div>
                    <?= $form->field($model, 'project_status_id')->dropDownList(ArrayHelper::map(ProjectStatus::find()->all(),'id','project_status'),['prompt'=>'']) ?>

                    <?php ActiveForm::end(); ?>
                </div>
                <div class="modal-footer">
                    <?php
                echo yii\helpers\Html::a("ບັນ​ທືກ", '#', [
                    'onclick' => "
                            $.ajax({
                            type     :'POST',
                            cache    : false,
                            url  : 'index.php?r=project/projectprocesscreate',
                            data: {
                                year: $('#projectprogression-project_year').val(),
                                amount_proposal: $('#projectprogression-proposal_amount').val(),
                                amount_approved: $('#projectprogression-aproved_amount').val(),
                                status: $('#projectprogression-project_status_id').val(),
                                project_id:".$_GET['project_id'].",
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
</div>