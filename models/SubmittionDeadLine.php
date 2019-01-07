<?php

namespace app\models;

use Yii;
use \app\models\base\SubmittionDeadLine as BaseSubmittionDeadLine;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "submittion_dead_line".
 */
class SubmittionDeadLine extends BaseSubmittionDeadLine
{

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                # custom validation rules
            ]
        );
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(
            parent::rules(), 
            [
            'id' => Yii::t('models', 'ລະ​ຫັດ'),
            'current_year' => Yii::t('models', 'ປີ'),
            'dead_line' => Yii::t('models', 'ໝົດ​ກຳ​ນົດ​ສົ່ງ'),
            ]
        );
    }
}
