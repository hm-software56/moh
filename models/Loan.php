<?php

namespace app\models;

use Yii;
use \app\models\base\Loan as BaseLoan;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "loan".
 */
class Loan extends BaseLoan
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
                'amount' => Yii::t('models', 'ຈຳ​ນວນເງິນກູ້ຢືມ/​ລ້ານ​ກີບ'),
                'interest_rate' => Yii::t('models', '​ອັດ​ຕາ​ດອກ​ເບ້ຍ'),
            ],
            parent::rules()
        );
    }
    public function afterFind()
    {
        $this->amount=number_format($this->amount,2);
        $this->interest_rate=number_format($this->interest_rate,2);
    }
}
