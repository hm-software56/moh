<?php

namespace app\models;

use Yii;
use \app\models\base\Department as BaseDepartment;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "department".
 */
class Department extends BaseDepartment
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
}
