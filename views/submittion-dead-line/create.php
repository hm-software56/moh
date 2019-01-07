<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SubmittionDeadLine */

$this->title = Yii::t('app', 'ກຳ​ນົດ​ວັນ​ທີ​ສົ່ງ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ກຳ​ນົດ​ວ​ັນ​ທີ​ໝົດ​ກຳ​ນົດ​ສົ່ງ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="submittion-dead-line-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
