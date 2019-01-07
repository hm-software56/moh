<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DepartmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ພະ​ແນ​ກ');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-index">
    <?php Pjax::begin(); ?>
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p align="right">
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> '.Yii::t('app', 'ເພີ່ມພະ​ແນ​ກ'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary'=>'',
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],
          // 'id',
           //'department_name' ,
           [
                'attribute'=>'id',
                'label'=>Yii::t('app','ລະ​ຫັດ'),
                'value'=>function($data)
                    {
                        return $data->id;
                    }
            ],

            [
                'attribute'=>'department_name',
                'label'=>Yii::t('app','ຊື່​ພະ​ແນກ'),
                'value'=>function($data)
                    {
                        return $data->department_name;
                    }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a(
                                    '<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                    'class' => 'btn btn-primary btn-xs',
                                    'title'=>'View',
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
                
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
