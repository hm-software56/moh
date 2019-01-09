<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

//$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-4"></div>
<div class="col-md-4">
    <div class="site-login">
        <div style="font-size:18px;border-bottom: 2px solid red; padding-top:140px;">​<?=Yii::t('app','​ທ່ານປ້ອນ​ຊື່​ແລະ​ຫັດ​ຜານ')?></div>
        <br/>
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
           /* 'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-1 control-label'],
            ],*/
        ]); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label(Yii::t('app','ປ້ອນ​ຊື່​ເຂົ້າ​ລະ​ບົບ')) ?>

            <?= $form->field($model, 'password')->passwordInput()->label(Yii::t('app','ປ້ອນ​ລະ​ຫັດ​ຜ່ານ​')) ?>

            <div class="form-group">
                <div class="col-md-12" align="right">
                    <?= Html::submitButton('<span class="glyphicon glyphicon-lock" ></span> ເຂົ້າ​ລະ​ບົບ', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
<div class="col-md-4"></div>