<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GroupProjectTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ກູ່ມ​ປະ​ເພດ​ໂຄງ​ການ');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-project-type-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p align="right">
        <?= Html::a(Yii::t('app', 'ເພີ່ມກູ່ມ​ປະ​ເພດ​ໂຄງ​ການ'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary'=>'',
        'columns' => [
            'id',
            'group_name',
            'min_amount',
            'max_amount',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>' {update} {delete}',
                'buttons' => [

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
</div>