<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\ProjectType;
use app\models\ProjectStatus;
use app\models\Project;

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
                        <?php
                        
                        $project=Project::find()->where(['id'=>Yii::$app->session['project_id']])->one();
                            if(!empty($project->is_oda))
                            {
                        ?>
                        <div class="col-md-4">
                            <?= $form->field($model, 'proposal_amount')->textInput(['maxlength' => true,'class'=>"form-control money_format"]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'aproved_amount')->textInput(['maxlength' => true,'class'=>"form-control money_format"]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'aproved_amount_oda')->textInput(['maxlength' => true,'class'=>"form-control money_format"]) ?>
                        </div>
                        <?php
                            }else{
                                ?>
                        <div class="col-md-6">
                            <?= $form->field($model, 'proposal_amount')->textInput(['maxlength' => true,'class'=>"form-control money_format"]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'aproved_amount')->textInput(['maxlength' => true,'class'=>"form-control money_format"]) ?>
                        </div>
                        <?php
                            }
                        ?>
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
                            url  : 'index.php?r=project/projectprocesscreate&progress_id=".$progress_id."',
                            data: {
                                year: $('#projectprogression-project_year').val(),
                                amount_proposal: $('#projectprogression-proposal_amount').val(),
                                amount_approved: $('#projectprogression-aproved_amount').val(),
                                amount_approved_oda: $('#projectprogression-aproved_amount_oda').val(),
                                status: $('#projectprogression-project_status_id').val(),
                                project_id:'".Yii::$app->session['project_id']."',
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