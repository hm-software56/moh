<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = Yii::t('app', 'ເພີ່ມ​ໂຄງ​ການ​ໃໝ່');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '​ໂຄງ​ການ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
