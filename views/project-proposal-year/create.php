<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProjectProposalYear */

$this->title = Yii::t('app', 'ປ້ອນໂຄງການສະເຫນີ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ສະເຫນີໂຄງການ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-proposal-year-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
