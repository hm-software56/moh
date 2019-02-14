<?php

namespace app\models;

use Yii;
use \app\models\base\ProjectPayment as BaseProjectPayment;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "project_payment".
 */
class ProjectPayment extends BaseProjectPayment
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
            
            [
                'id' => Yii::t('models', 'ລະ​ຫັດ'),
                'is_oda' => Yii::t('models', '​ເປັ​ນ ODA'),
                'amount' => Yii::t('models', 'ຈຳ​ນວນ​ເງີນ​ຊຳ​ລະ'),
            ],
            parent::rules()
        );
    }

    public function afterFind()
    {
        $this->amount=\number_format($this->amount,2);
    }
}
