<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\SubmittionDeadLine;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectProposalYearSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ສະເຫນີໂຄງການ');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-proposal-year-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'ປ້ອນໂຄງການສະເຫນີ'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary'=>'',
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'department_id',
                'value'=>function($data)
                    {
                        return $data->department->department_name;
                    }
            ],
            'submit_year',
            [
                'attribute'=>'date',
                'value'=>function($data)
                    {
                        return date('Y-m-d',strtotime($data->date));
                    }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete}',
                'visibleButtons' => [
                    'update' => function ($model) {
                        $deadline=SubmittionDeadLine::find()->where('dead_line>="'.$model->submit_year.date('-m-d').'"')->andWhere(['current_year'=>$model->submit_year])->one();
                        return !empty($deadline)?true:false;
                     },
                     'delete' => function ($model) {
                        $deadline=SubmittionDeadLine::find()->where('dead_line>="'.$model->submit_year.date('-m-d').'"')->andWhere(['current_year'=>$model->submit_year])->one();
                        return !empty($deadline)?true:false;
                     }
                    ],
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
