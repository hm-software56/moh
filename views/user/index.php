<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ຜູ້​ໃຊ້');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p align="right">
        <?= Html::a(Yii::t('app', 'ເພີ່ມ​ຜູ້​ໃຊ້'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary'=>'',
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'id',
                'value'=>function($data)
                    {
                        return $data->id;
                    },
                'contentOptions' => ['style' => 'width: 20px'],
            ],
            'first_name',
            'last_name',
            'email:email',
            [
                'attribute'=>'password',
                'value'=>function($data)
                    {
                        $ct="";
                        for($i=1;$i<=strlen($data->password);$i++)
                        {
                            $ct.="*";
                        }
                        return $ct;
                    }
            ],
            //'password',
            //'department_id',
            [
                'attribute'=>'department_id',
                'value'=>function($data)
                    {
                        return $data->department->department_name;
                    }
            ],
            [
                'attribute'=>'type',
                'value'=>function($data)
                    {
                        return $data->type;
                    }
            ],
            //'mobile',
            //'status',

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
