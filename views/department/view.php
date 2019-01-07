<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Department */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ພະ​ແນກ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-view">


    <p>
        <?= Html::a(Yii::t('app', 'ແກ້​ໄຂ'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', '​ລືບ'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [  
                'label' => Yii::t('app','ລະ​ຫັດ'),
                'value' => $model->id,
            ],

            [  
                'label' => Yii::t('app','​ພະ​ແນກ'),
                'value' => $model->department_name,
            ],
        ],
    ]) ?>

</div>
