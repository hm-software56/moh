<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Ministry;
use kartik\select2\Select2;
use app\models\EmployeeLevel;
?>

<?php $form = ActiveForm::begin([]); ?>
    <?php
    echo $form->field($model, 'year')->textInput();
    ?>
    <?php
    echo $form->field($model, 'ministry_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Ministry::find()->all(),'id','name'),
        'language' => 'en',
        'options' => ['multiple' => true, 'placeholder' =>Yii::t('app','ເລືອກ​ກົມ')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-eye-open"></span> '.Yii::t('app', 'ເບີ່ງ'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <?php
if (!empty($model->year)) {
    ?>
<div class="table-responsive">
    <table class="table table-bordered">
    <tr>
        <td rowspan="3">ລ​ດ</td>
        <td rowspan="3" style="width:250px !important;">​ກະ​ຊວງ</td>
        <td colspan="3" rowspan="2">​ລວມ​ທັງ​ໝົດ</td>
        <td colspan="6">​ປະ​ລີນ​ຍາ​ເອກ</td>
        <td colspan="6">ປະ​ລີນ​ຍາ​ໂທ</td>
        <td colspan="6">ປະ​ລີນ​ຍາ​ຕີ</td>
        <td colspan="6">​ຊັ້ນ​ສູງ ຫຼື ທຽບ​ເທົ່າ</td>
        <td colspan="6">​ຊັ້ນ​ກາງ</td>
        <td colspan="6">​ຊັ້​ນ​ຕົ້ນ</td>
    </tr>
    <tr>
        <td colspan="3">​ພາຍ​ໃນ</td>
        <td colspan="3">ຕ່າງ​ປະ​ເທດ</td>
        <td colspan="3">ພາຍ​ໃນ</td>
        <td colspan="3">ຕ່າງ​ປະ​ເທດ</td>
        <td colspan="3">ພາຍ​ໃນ</td>
        <td colspan="3">ຕ່າງ​ປະ​ເທດ</td>
        <td colspan="3">ພາຍ​ໃນ</td>
        <td colspan="3">ຕ່າງ​ປະ​ເທດ</td>
        <td colspan="3">ພາຍ​ໃນ</td>
        <td colspan="3">ຕ່າງ​ປະ​ເທດ</td>
        <td colspan="3">ພາຍ​ໃນ</td>
        <td colspan="3">ຕ່າງ​ປະ​ເທດ</td>
    </tr>
    <tr>
        <td>ລວມ</td>
        <td>ຊາຍ</td>
        <td>ຍີງ</td>
        <td>​ລວມ</td>
        <td>ຊາຍ</td>
        <td>ຍີງ</td>
        <td>ລວມ</td>
        <td>ຊາຍ</td>
        <td>ຍີງ</td>
        <td>ລວມ</td>
        <td>ຊາຍ</td>
        <td>ຍີງ</td>
        <td>ລວມ</td>
        <td>ຊາຍ</td>
        <td>ຍີງ</td>
        <td>ລວມ</td>
        <td>ຊາຍ</td>
        <td>ຍີງ</td>
        <td>ລວມ</td>
        <td>ຊາຍ</td>
        <td>ຍີງ</td>
        <td>ລວມ</td>
        <td>ຊາຍ</td>
        <td>ຍີງ</td>
        <td>ລວມ</td>
        <td>ຊາຍ</td>
        <td>ຍີງ</td>
        <td>ລວມ</td>
        <td>ຊາຍ</td>
        <td>ຍີງ</td>
        <td>ລວມ</td>
        <td>ຊາຍ</td>
        <td>ຍີງ</td>
        <td>ລວມ</td>
        <td>ຊາຍ</td>
        <td>ຍີງ</td>
        <td>ລວມ</td>
        <td>ຊາຍ</td>
        <td>ຍີງ</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>ລວ​ມ</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <?php
    $minstrys=EmployeeLevel::find()
        ->joinWith('ministry', true)
        ->where(['in', 'ministry_id', $model->ministry_id])
        ->andWhere(['year'=>$model->year])
       // ->orderBy('ministry_id ASC')
        ->all();
        $i=0;
    foreach ($minstrys as $minstry) {
        $i++;
        ?>
    <tr>
        <td><?=$i?></td>
        <td ><?=$minstry->ministry->name?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>

        <td><?=$minstry->phd_male_in+$minstry->phd_female_in?></td>
        <td><?=$minstry->phd_male_in?></td>
        <td><?=$minstry->phd_female_in?></td>

        <td><?=$minstry->phd_male_out+$minstry->phd_female_out?></td>
        <td><?=$minstry->phd_male_out?></td>
        <td><?=$minstry->phd_female_out?></td>

        <td><?=$minstry->master_male_in+$minstry->master_female_in?></td>
        <td><?=$minstry->master_male_in?></td>
        <td><?=$minstry->master_female_in?></td>

        <td><?=$minstry->master_male_out+$minstry->master_female_out?></td>
        <td><?=$minstry->master_male_out?></td>
        <td><?=$minstry->master_female_out?></td>

        <td><?=$minstry->bachelor_degree_male_in+$minstry->bachelor_degree_female_in?></td>
        <td><?=$minstry->bachelor_degree_male_in?></td>
        <td><?=$minstry->bachelor_degree_male_in?></td>

        <td><?=$minstry->bachelor_degree_male_out+$minstry->bachelor_degree_female_out?></td>
        <td><?=$minstry->bachelor_degree_male_out?></td>
        <td><?=$minstry->bachelor_degree_male_out?></td>

        <td><?=$minstry->bachelor_male_in+$minstry->bachelor_female_in?></td>
        <td><?=$minstry->bachelor_male_in?></td>
        <td><?=$minstry->bachelor_female_in?></td>

        <td><?=$minstry->bachelor_male_out+$minstry->bachelor_female_out?></td>
        <td><?=$minstry->bachelor_male_out?></td>
        <td><?=$minstry->bachelor_female_out?></td>
        
        <td><?=$minstry->middle_diploma_male_in+$minstry->middle_diploma_female_in?></td>
        <td><?=$minstry->middle_diploma_male_in?></td>
        <td><?=$minstry->middle_diploma_female_in?></td>

        <td><?=$minstry->middle_diploma_male_out+$minstry->middle_diploma_female_out?></td>
        <td><?=$minstry->middle_diploma_male_out?></td>
        <td><?=$minstry->middle_diploma_female_out?></td>

        <td><?=$minstry->lower_diploma_male_in+$minstry->lower_diploma_female_in?></td>
        <td><?=$minstry->lower_diploma_male_in?></td>
        <td><?=$minstry->lower_diploma_female_in?></td>

        <td><?=$minstry->lower_diploma_male_out+$minstry->lower_diploma_female_out?></td>
        <td><?=$minstry->lower_diploma_male_out?></td>
        <td><?=$minstry->lower_diploma_female_out?></td>
    </tr>
    <?php
    } ?>
</table>
</div>
<?php
}
?>