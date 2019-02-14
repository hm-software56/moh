<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProjectStatus */

$this->title = Yii::t('app', 'ເພີ່ມ​ສະ​ຖາ​ນະ​ໂຄງການ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ເພີ່ມ​ສະ​ຖາ​ນະ​ໂຄງການ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-status-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
