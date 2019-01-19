<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Ministry;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\EmployeeLevel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-level-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
        <?= $form->field($model, 'year')->textInput() ?>
        </div>
        <div class="col-md-6">
        <?php
            echo $form->field($model, 'ministry_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Ministry::find()->all(),'id','name'),
                'language' => 'en',
                'options' => ['multiple' => false, 'placeholder' =>Yii::t('app','ເລືອກ​ກົມ')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
        ?>
        </div>
    </div>
    <fieldset class="scheduler-border">
        <legend class="scheduler-border"><?="ປະ​ລີນ​ຍາ​ເອກ​"?></legend>
        <div class="control-group">
            <div class="row">
                <div class="col-md-3">
                <?= $form->field($model, 'phd_male_in')->textInput()->label('ຈຳ​ນວນ​​ຜູ້​ຊາຍຈົບ​​ພາຍ​ໃນ') ?>
                </div>
                <div class="col-md-3">
                <?= $form->field($model, 'phd_female_in')->textInput()->label('ຈຳ​ນວນ​​ຜູ້​ຍີງຈົບ​​ພາຍ​ໃນ') ?>
                </div>
                <div class="col-md-3">
                <?= $form->field($model, 'phd_male_out')->textInput()->label('ຈຳ​ນວນ​​ຜູ້​ຊາຍຈົບ​​ຕ່າງ​ປະ​ເທດ') ?>
                </div>
                <div class="col-md-3">
                <?= $form->field($model, 'phd_female_out')->textInput()->label('ຈຳ​ນວນ​​ຜູ້​ຍີງຈົບ​​ຕ່າງ​ປະ​ເທດ') ?>
                </div>
            </div>
        </div>
    </fieldset>
    
    <fieldset class="scheduler-border">
        <legend class="scheduler-border"><?="​ປະ​ລີນ​ຍາໂທ​"?></legend>
        <div class="control-group">
            <div class="row">
                <div class="col-md-3">
                <?= $form->field($model, 'master_male_in')->textInput()->label('ຈຳ​ນວນ​​ຜູ້​ຊາຍຈົບ​​ພາຍ​ໃນ')  ?>
                </div>
                <div class="col-md-3">
                <?= $form->field($model, 'master_female_in')->textInput()->label('ຈຳ​ນວນ​​ຜູ້​ຍີງຈົບ​​ພາຍ​ໃນ') ?>
                </div>
                <div class="col-md-3">
                <?= $form->field($model, 'master_male_out')->textInput()->label('ຈຳ​ນວນ​​ຜູ້​ຊາຍຈົບ​​ຕ່າງ​ປະ​ເທດ') ?>
                </div>
                <div class="col-md-3">
                <?= $form->field($model, 'master_female_out')->textInput()->label('ຈຳ​ນວນ​​ຜູ້​ຍີງຈົບ​​ຕ່າງ​ປະ​ເທດ')  ?>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset class="scheduler-border">
        <legend class="scheduler-border"><?="​ປະ​ລີນ​ຍາຕີນ"?></legend>
        <div class="control-group">
            <div class="row">
                <div class="col-md-3">
                <?= $form->field($model, 'bachelor_degree_male_in')->textInput()->label('ຈຳ​ນວນ​​ຜູ້​ຊາຍຈົບ​​ພາຍ​ໃນ')  ?>
                </div>
                <div class="col-md-3">
                <?= $form->field($model, 'bachelor_degree_female_in')->textInput()->label('ຈຳ​ນວນ​​ຜູ້​ຍີງຈົບ​​ພາຍ​ໃນ') ?>
                </div>
                <div class="col-md-3">
                <?= $form->field($model, 'bachelor_degree_male_out')->textInput()->label('ຈຳ​ນວນ​​ຜູ້​ຊາຍຈົບ​​ຕ່າງ​ປະ​ເທດ') ?>
                </div>
                <div class="col-md-3">
                <?= $form->field($model, 'bachelor_degree_female_out')->textInput()->label('ຈຳ​ນວນ​​ຜູ້​ຍີງຈົບ​​ຕ່າງ​ປະ​ເທດ') ?>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset class="scheduler-border">
        <legend class="scheduler-border"><?="ຊັ້ນ​ສ​ູງ ຫຼື ທຽບ​ເທົ່າ"?></legend>
        <div class="control-group">
            <div class="row">
                <div class="col-md-3">
                <?= $form->field($model, 'bachelor_male_in')->textInput()->label('ຈຳ​ນວນ​​ຜູ້​ຊາຍຈົບ​​ພາຍ​ໃນ') ?>
                </div>
                <div class="col-md-3">
                <?= $form->field($model, 'bachelor_female_in')->textInput()->label('ຈຳ​ນວນ​​ຜູ້​ຍີງຈົບ​​ພາຍ​ໃນ') ?>
                </div>
                <div class="col-md-3">
                <?= $form->field($model, 'bachelor_male_out')->textInput()->label('ຈຳ​ນວນ​​ຜູ້​ຊາຍຈົບ​​ຕ່າງ​ປະ​ເທດ') ?>
                </div>
                <div class="col-md-3">
                <?= $form->field($model, 'bachelor_female_out')->textInput()->label('ຈຳ​ນວນ​​ຜູ້​ຍີງຈົບ​​ຕ່າງ​ປະ​ເທດ') ?>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset class="scheduler-border">
        <legend class="scheduler-border"><?="ຊັ້ນ​​ກາງ"?></legend>
        <div class="control-group">
            <div class="row">
                <div class="col-md-3">
                <?= $form->field($model, 'middle_diploma_male_in')->textInput()->label('ຈຳ​ນວນ​​ຜູ້​ຊາຍຈົບ​​ພາຍ​ໃນ') ?>
                </div>
                <div class="col-md-3">
                <?= $form->field($model, 'middle_diploma_female_in')->textInput()->label('ຈຳ​ນວນ​​ຜູ້​ຍີງຈົບ​​ພາຍ​ໃນ')  ?>
                </div>
                <div class="col-md-3">
                <?= $form->field($model, 'middle_diploma_male_out')->textInput()->label('ຈຳ​ນວນ​​ຜູ້​ຊາຍຈົບ​​ຕ່າງ​ປະ​ເທດ') ?>
                </div>
                <div class="col-md-3">
                <?= $form->field($model, 'middle_diploma_female_out')->textInput()->label('ຈຳ​ນວນ​​ຜູ້​ຍີງຈົບ​​ຕ່າງ​ປະ​ເທດ') ?>
                </div>
            </div>
        </div>
    </fieldset>
    
    <fieldset class="scheduler-border">
        <legend class="scheduler-border"><?="ຊັ້ນ​​ຕົ້ນ"?></legend>
        <div class="control-group">
            <div class="row">
                <div class="col-md-3">
                <?= $form->field($model, 'lower_diploma_male_in')->textInput()->label('ຈຳ​ນວນ​​ຜູ້​ຊາຍຈົບ​​ພາຍ​ໃນ') ?>
                </div>
                <div class="col-md-3">
                <?= $form->field($model, 'lower_diploma_female_in')->textInput()->label('ຈຳ​ນວນ​​ຜູ້​ຍີງຈົບ​​ພາຍ​ໃນ')  ?>
                </div>
                <div class="col-md-3">
                <?= $form->field($model, 'lower_diploma_male_out')->textInput()->label('ຈຳ​ນວນ​​ຜູ້​ຊາຍຈົບ​​ຕ່າງ​ປະ​ເທດ') ?>
                </div>
                <div class="col-md-3">
                <?= $form->field($model, 'lower_diploma_female_out')->textInput()->label('ຈຳ​ນວນ​​ຜູ້​ຍີງຈົບ​​ຕ່າງ​ປະ​ເທດ') ?>
                </div>
            </div>
        </div>
    </fieldset>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
