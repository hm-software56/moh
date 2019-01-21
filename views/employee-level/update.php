<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EmployeeLevel */

$this->title = Yii::t('app', 'Update Employee Level: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ຍົກລະ​ດັບ​ຢູ່​ພາຍ​ໃນ ແລະ ​ຕ່າງ​ປະ​ເທດ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'ແກ້​ໄຂ');
?>
<div class="employee-level-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
