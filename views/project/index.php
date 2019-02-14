<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '​ໂຄງ​ການ');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p align="right">
        <?= Html::a(Yii::t('app', '​ເພີ່ມ​ໂຄງ​ການ​ໃໝ່'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary'=>'',
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'project_code',
            'project_name',
            //'sector_code',
           
            //'budget_code',
            'project_start_year',
            'project_end_year',
            //'payment_start_year',
            //'payment_end_year',
            //'project_type_id',
            //'govt_budget',
            //'approved_govt_budget',
            //'oda_budget',
           // 'approved',
            [
                'attribute'=>'approved',
                'value'=>function($data)
                {
                    if($data->approved==1)
                    {
                        return Yii::t('app','ອາ​ນຸ​ມັດ');
                    }elseif($data->approved==0){
                        return Yii::t('app','ບໍ່ອາ​ນຸ​ມັດ');
                    }else{
                        return Null;
                    }
                }
            ],
            //'is_oda',
            //'evaluation_at_plan',
            //'final_evaluation',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a(
                                    '<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                    'class' => 'btn btn-primary btn-xs',
                                    ]
                        );
                    },

                    'update' => function ($url, $model) {
                        return Html::a(
                                    '<span class="glyphicon glyphicon-edit"></span>', $url, [
                                    'class' => 'btn btn-success btn-xs',
                                    ]
                        );
                    },

                    'delete' => function ($url, $model) {
                        return Html::a(
                                    '<span class="glyphicon glyphicon-remove"></span>', $url, [
                                    'data-method' => "post",
                                    'data-confirm' => Yii::t('app', 'Are you want to delete this item.?'),
                                    'class' => 'btn btn-danger btn-xs',
                                    ]
                        );
                    },

                ],
                'contentOptions' => ['style' => 'width: 120px'],
            ],
        ],
    ]); ?>
</div>