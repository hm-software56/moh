<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\SubmittionDeadLine */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="submittion-dead-line-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
    $year=[
        date('Y',strtotime('0 year'))=>date('Y',strtotime('0 year')),
        date('Y',strtotime('1 year'))=>date('Y',strtotime('1 year')),
        date('Y',strtotime('2 year'))=>date('Y',strtotime('2 year')),
        date('Y',strtotime('3 year'))=>date('Y',strtotime('3 year'))
        
    ];
    echo $form->field($model, 'current_year')->dropDownList($year);
    ?>

    <?php //$form->field($model, 'dead_line')->textInput() ?>
    <?php
    echo $form->field($model, 'dead_line')->widget(\yii\jui\DatePicker::classname(), [
        'dateFormat' => 'yyyy-MM-dd',
        'clientOptions' => [
            'changeMonth' => false,
            'changeYear' => true,
            'yearRange' => ''.date('Y').':'.date('Y',strtotime('2 year')).''
        ],
        'options' => [
            'class' => 'form-control',
            'autocomplete'=>'off'
            ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
