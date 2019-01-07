<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SubmittionDeadLine */

$this->title = Yii::t('app', 'Update Submittion Dead Line: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ກຳ​ນົດ​ວ​ັນ​ທີ​ໝົດ​ກຳ​ນົດ​ສົ່ງ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'ແກ້​ໄຂ');
?>
<div class="submittion-dead-line-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
