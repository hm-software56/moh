<?php

namespace app\models;

use Yii;
use \app\models\base\Project as BaseProject;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "project".
 */
class Project extends BaseProject
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
               // [['govt_budget', 'oda_budget'], 'string'],
                [['sector_code','project_code','budget_code'],'default','value' => NULL],
                # custom validation rules
            ],
            parent::rules()
        );
    }
    public function attributeLabels()
    {
        return ArrayHelper::merge(
            [
                'project_name' => Yii::t('models', 'ຊື່​ໂຄງ​ການ'),
                'sector_code' => Yii::t('models', '​ລະ​ຫັດ​ຂະ​ແໜງ'),
                'project_code' => Yii::t('models', 'ລະ​ຫັດ​ໂຄງ​ການ'),
                'budget_code' => Yii::t('models', 'ລະ​ຫັດ​ງົບ​ປະ​ມານ'),
                'project_start_year' => Yii::t('models', '​ປີ​ເລີ່ມ​ໂຄງ​ການ'),
                'project_end_year' => Yii::t('models', '​ປີ​ສີ້ນ​ສຸດໂຄງ​ການ'),
                'payment_start_year' => Yii::t('models', '​ປີ​ເລີ່ມ​ຈ່າຍ​ເງີນ'),
                'payment_end_year' => Yii::t('models', 'ປີ​ສີ້ນ​ສຸດ​ຈ່າຍ​ເງີນ'),
                'project_type_id' => Yii::t('models', 'ປະ​ເພດ​ໂຄງ​ການ'),
                'govt_budget' => Yii::t('models', 'ງົບ​ປະ​ມານ​ຂອງ​ລັດ/​ລ້ານ​ກີບ'),
                'approved_govt_budget' => Yii::t('models', 'ອະ​ນຸ​ມັດ​ງົບ​ປະ​ມານ​ລັດ/​ລ້ານ​ກີບ'),
                'oda_budget' => Yii::t('models', 'ງົບ​ປະ​ມານ​ຂອງ ODA/​ລ້ານ​ກີບ'),
                'approved' => Yii::t('models', 'ອະ​ນຸ​ມັດ'),
                'is_oda' => Yii::t('models', 'ເປັນ ODA'),
                'evaluation_at_plan' => Yii::t('models', 'ແຜນການປະເມີນຜົນ'),
                'final_evaluation' => Yii::t('models', 'ການປະເມີນຜົນສຸດທ້າຍ'),
            ],
            parent::rules()
        );
    }

    public function beforeValidate()
    {
        //echo $this->govt_budget;exit;
        if (parent::beforeValidate()) {
            return true;
        }
        return false;
    }

    public function afterFind()
    {
        $this->govt_budget=number_format($this->govt_budget,2);
        $this->approved_govt_budget=number_format($this->approved_govt_budget,2);
        $this->oda_budget=number_format($this->oda_budget,2);
    }
}
