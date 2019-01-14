<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
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
          <h4 class="modal-title"><?=Yii::t('app','​ອັບ​ໂຫລດ​ໄຟ​ຣ')?></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                <?php $form = ActiveForm::begin(['id'=>'file_upload']); ?>
                <?= $form->field($model, 'name')->fileInput()->label(Yii::t('app','ໄຟ​ຣ'),['class'=>"text-primary"]) ?>
                <div class="form-group">
                    <?= Html::submitButton('<span class="glyphicon glyphicon-floppy-disk"></span> '.Yii::t('app', '​ອັບ​ໂຫຼດ'), ['class' => 'btn btn-success btn-sm']) ?>
                </div>

                <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            
        </div>
      </div>
      
    </div>
  </div>