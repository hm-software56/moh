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
                    <?php
                        if($timespay==1){
                            ?>
                    <h4 class="modal-title">
                        <b><?=Yii::t('app','​​ຊຳລະ​ເງີນ 6 ​ຕົ້ນ​ປີ').": ".$projectprogress->project_year?></b></h4>
                    <?php
                        }else{
                            ?>
                    <h4 class="modal-title">
                        <b><?=Yii::t('app','​ຊຳ​ລະ​ເງີນ 6 ​ທ້າຍ​ປີ').": ".$projectprogress->project_year?></b></h4>
                    <?php
                        }
                    ?>

                </div>
                <div class="modal-body">
                    <?php $form = ActiveForm::begin(['id' => 'process-form']); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($model, 'amount')->textInput(['maxlength' => true,'class'=>"form-control money_format"]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            $project=Project::find()->where(['id'=>Yii::$app->session['project_id']])->one();
                            if(!empty($project->is_oda))
                            {
                                echo $form->field($model, 'is_oda')->dropDownList([0=>'No',1=>'Yes']);
                            }else{
                                echo $form->field($model, 'is_oda')->dropDownList([0=>'No']);
                            }
                            ?>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
                <div class="modal-footer">
                    <?php
                echo yii\helpers\Html::a("ບັນ​ທືກ", '#', [
                    'onclick' => "
                            $.ajax({
                            type     :'POST',
                            cache    : false,
                            url  : 'index.php?r=project/projectpay&timespay=".$_GET['timespay']."&progress_id=".$_GET['progress_id']."',
                            data: {
                                is_oda: $('#projectpayment-is_oda').val(),
                                amount: $('#projectpayment-amount').val(),
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