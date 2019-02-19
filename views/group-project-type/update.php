<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GroupProjectType */

$this->title = Yii::t('app', 'Update Group Project Type: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ກູ່ມ​ປະ​ເພດ​ໂຄງ​ການ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', '​ແກ້​ໄຂ');
?>
<div class="group-project-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
