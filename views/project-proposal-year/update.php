<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectProposalYear */

$this->title = Yii::t('app', 'Update Project Proposal Year: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ສະເຫນີໂຄງການ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'ແກ້​ໄຂ');
?>
<div class="project-proposal-year-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
