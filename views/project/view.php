<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-view">
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <table class="table table-bordered">
        <tr>
            <th><?=$model->getAttributeLabel('project_type_id')?></th>
            <td colspan="8"><?=$model->projectType->project_type?></td>
        </tr>
        <tr>
            <th><?=$model->getAttributeLabel('project_name')?></th>
            <td colspan="8"><?=$model->project_name?></td>
        </tr>
        <tr>
            <th><?=$model->getAttributeLabel('sector_code')?></th>
            <td><?=$model->sector_code?></td>
            <th><?=$model->getAttributeLabel('project_code')?></th>
            <td><?=$model->project_code?></td>
            <th><?=$model->getAttributeLabel('budget_code')?></th>
            <td colspan="3"><?=$model->budget_code?></td>
        </tr>
        <tr>
            <th><?=$model->getAttributeLabel('project_start_year')?></th>
            <td><?=$model->project_start_year?></td>
            <th><?=$model->getAttributeLabel('project_end_year')?></th>
            <td><?=$model->project_end_year?></td>
            <th><?=$model->getAttributeLabel('payment_start_year')?></th>
            <td><?=$model->payment_start_year?></td>
            <th><?=$model->getAttributeLabel('payment_end_year')?></th>
            <td><?=$model->payment_end_year?></td>
        </tr>
    </table>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'project_name',
            'sector_code',
            'project_code',
            'budget_code',
            'project_start_year',
            'project_end_year',
            'payment_start_year',
            'payment_end_year',
            'project_type_id',
            'govt_budget',
            'approved_govt_budget',
            'oda_budget',
            'approved',
            'is_oda',
            'evaluation_at_plan',
            'final_evaluation',
        ],
    ]) ?>

</div>
