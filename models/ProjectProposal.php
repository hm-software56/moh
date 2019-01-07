<?php

namespace app\models;

use Yii;
use \app\models\base\ProjectProposal as BaseProjectProposal;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "project_proposal".
 */
class ProjectProposal extends BaseProjectProposal
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
