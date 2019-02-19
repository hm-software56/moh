<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GroupProjectType */

$this->title = Yii::t('app', 'ເພີ່ມກູ່ມ​ປະ​ເພດ​ໂຄງ​ການ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ກູ່ມ​ປະ​ເພດ​ໂຄງ​ການ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-project-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
