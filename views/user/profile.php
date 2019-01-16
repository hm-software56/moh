<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

?>
<div class="user-view">

    <p align="right">
        <?= Html::a(Yii::t('app', 'ແກ້​ໄຂ'), ['editeprofile'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'first_name',
            'last_name',
            'email:email',
            [
                'label' => Yii::t('app','ລ​ະ​ຫັດ​ຜ່ານ'),
                'value' =>function($data)
                {
                    $ct="";
                    for($i=1;$i<=strlen($data->password);$i++)
                    {
                        $ct.="*";
                    }
                    return $ct;
                }
            ],
            //'department_id',
            [  
                'label' => Yii::t('app','ພະ​ແນກ'),
                'value' => $model->department->department_name,
            ],
            
            'mobile',
        ],
    ]) ?>

</div>
