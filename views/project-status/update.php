<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectStatus */

$this->title = Yii::t('app', 'Update Project Status: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ສະ​ຖາ​ນະ​ໂຄງ​ການ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', '​ແກ້​ໄຂ');
?>
<div class="project-status-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
