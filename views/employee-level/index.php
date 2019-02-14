<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmployeeLevelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ຍົກລະ​ດັບ​ຢູ່​ພາຍ​ໃນ ແລະ ​ຕ່າງ​ປະ​ເທດ');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-level-index">
    <p>
        <?= Html::a(Yii::t('app', 'ປ້ອນ​ສັງ​ລວມຍົກລະ​ດັບ​ຢູ່​ພາຍ​ໃນ ແລະ ​ຕ່າງ​ປະ​ເທດ'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
          //  ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'ministry_id',
                'value'=>function($data)
                    {
                        return $data->ministry->name;
                    },
            ],
            'year',

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
