<?php

namespace app\models;

use Yii;
use \app\models\base\ProjectType as BaseProjectType;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "project_type".
 */
class ProjectType extends BaseProjectType
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
                'project_type' => Yii::t('models', 'ປະ​ເພດ​ໂຄງ​ການ'),
            ],
            parent::rules()
        );
    }
}
