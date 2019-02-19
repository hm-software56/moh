<?php

namespace app\models;

use Yii;
use \app\models\base\GroupProjectType as BaseGroupProjectType;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "group_project_type".
 */
class GroupProjectType extends BaseGroupProjectType
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
                'id' => Yii::t('models', '​ລະ​ຫັດ'),
                'group_name' => Yii::t('models', '​ຊື່ກ​ຸ່ມ​ປະ​ເພດ​ໂຄງ​ການ'),
                'min_amount' => Yii::t('models', '​ຈຳ​ນວນ​ເງີນ​ຕ່ຳ​ສຸດ/​ລ້ານ​ກີບ​'),
                'max_amount' => Yii::t('models', 'ຈຳ​ນວນ​ເງີນ​ສູງສຸດ/​ລ້ານ​ກີບ'),
            ],
            parent::rules()
        );
    }
}
