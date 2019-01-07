<?php

namespace app\models;

use Yii;
use \app\models\base\ProjectProposalYear as BaseProjectProposalYear;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "project_proposal_year".
 */
class ProjectProposalYear extends BaseProjectProposalYear
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
            parent::attributeLabels(),
            [
                'id' => Yii::t('models', 'ID'),
                'submit_year' => Yii::t('models', 'ປີ​'),
                'department_id' => Yii::t('models', '​ພະ​ແນກ'),
            ]
        );
    }
}
