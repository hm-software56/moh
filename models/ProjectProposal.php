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

    public function attributeLabels()
    {
        return ArrayHelper::merge(
            parent::attributeLabels(),
            [
                'id' => Yii::t('models', 'ລະ​ຫັດ'),
                'project_name' => Yii::t('models', 'ຊື່​​ໂຄງ​ການ'),
                'start_year' => Yii::t('models', '​ປີ​ເລີ່ມ'),
                'end_year' => Yii::t('models', '​ປີ​ສີ້ນ​ສຸດ'),
                'amount' => Yii::t('models', '​ຈຳ​ນວນ​ເງີນ/​ລ້ານ​ກີບ'),
                'project_proposal_year_id' => Yii::t('models', 'Project Proposal Year ID'),
                'code_old_project' => Yii::t('models', 'ສະ​ຖາ​ນະ'),
            ]
        );
    }
}
