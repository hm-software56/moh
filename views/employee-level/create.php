<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EmployeeLevel */

$this->title = Yii::t('app', 'ປ້ອນຍົກ​ລະ​ດັບ​ຢູ່​ພາຍ​ໃນ ແລະ ​ຕ່າງ​ປະ​ເທດ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ຍົກລະ​ດັບ​ຢູ່​ພາຍ​ໃນ ແລະ ​ຕ່າງ​ປະ​ເທດ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-level-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
