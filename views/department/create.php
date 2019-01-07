<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Department */

$this->title = Yii::t('app', 'ເພີ່ມ​ພະ​ແນກ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ພະ​ແນກ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
