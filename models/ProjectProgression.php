<?php

namespace app\models;

use Yii;
use \app\models\base\ProjectProgression as BaseProjectProgression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "project_progression".
 */
class ProjectProgression extends BaseProjectProgression
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
            
            [
               // [['aproved_amount', 'proposal_amount'], 'string'],
            ],
            parent::rules()
        );
    }

    
    
    public function attributeLabels()
    {
        return ArrayHelper::merge(
            
            [
                'id' => Yii::t('models', 'ລະ​ຫັດ'),
                'project_id' => Yii::t('models', 'ໂຄງ​ການ'),
                'project_year' => Yii::t('models', 'ປີ'),
                'project_status_id' => Yii::t('models', 'ສະ​ຖານ​ະ'),
                'aproved_amount' => Yii::t('models', 'ຈຳ​ນວນ​ເງີນ​ອະ​ນຸ​ມັດ'),
                'proposal_amount' => Yii::t('models', 'ຈຳນວນ​ເງີນສະ​ເໜີ'),
            ],
            parent::rules()
        );
    }
    public function afterFind()
    {
        $this->aproved_amount=number_format($this->aproved_amount,2);
        $this->proposal_amount=number_format($this->proposal_amount,2);
    }
}
