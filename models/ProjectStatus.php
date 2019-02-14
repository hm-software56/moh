<?php

namespace app\models;

use Yii;
use \app\models\base\ProjectStatus as BaseProjectStatus;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "project_status".
 */
class ProjectStatus extends BaseProjectStatus
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
                'project_status' => Yii::t('models', '​ສ​ະ​ຖາ​ນະໂຄງ​ການ'),
            ],
            parent::rules()
        );
    }
}
