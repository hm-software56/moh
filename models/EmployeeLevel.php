<?php

namespace app\models;

use Yii;
use \app\models\base\EmployeeLevel as BaseEmployeeLevel;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "employee_level".
 */
class EmployeeLevel extends BaseEmployeeLevel
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
            parent::rules(),
            [
            'id' => Yii::t('models', 'ລະ​ຫັດ'),
            'year' => Yii::t('models', '​ປີ'),
            'phd_man_in' => Yii::t('models', 'ຈຳ​ນວນ​​ຜູ້​ຊາຍຈົບ​ປະ​ລີນ​ຍາ​ເອກ​ພາຍ​ໃນ'),
            'phd_feman_in' => Yii::t('models', 'ຈຳ​ນວນ​​ຜູ້​ຍີງຈົບ​ປະ​ລີນ​ຍາ​ເອກ​ພາຍ​ໃນ'),
            'phd_man_out' => Yii::t('models', 'ຈຳ​ນວນ​​ຜູ້​ຊາຍຈົບ​ປະ​ລີນ​ຍາ​ເອກ​​ຕ່າງ​ປະ​ເທດ'),
            'phd_feman_out' => Yii::t('models', 'ຈຳ​ນວນ​​ຜູ້​ຍີງຈົບ​ປະ​ລີນ​ຍາ​ເອກ​​ຕ່າງ​ປະ​ເທດ'),

            'master_man_in' => Yii::t('models', 'ຈຳ​ນວນ​​ຜູ້​ຊາຍຈົບ​ປະ​ລີນ​ຍາໂທ​ພາຍ​ໃນ'),
            'master_feman_in' => Yii::t('models', 'ຈຳ​ນວນ​​ຜູ້​ຍີງຈົບ​ປະ​ລີນ​ຍາ​ໂທ​ພາຍ​ໃນ'),
            'master_man_out' => Yii::t('models', 'ຈຳ​ນວນ​​ຜູ້​ຊາຍຈົບ​ປະ​ລີນ​ຍາໂທ​ຕ່າງ​ປະ​ເທດ'),
            'master_feman_out' => Yii::t('models', 'ຈຳ​ນວນ​​ຜູ້​ຍີງຈົບ​ປະ​ລີນ​ຍາໂທ​ຕ່າງ​ປະ​ເທດ'),

            'bachelor_degree_man_in' => Yii::t('models', 'ຈຳ​ນວນ​​ຜູ້​ຊາຍຈົບ​ປະ​ລີນ​ຍາຕີນ​ພາຍ​ໃນ'),
            'bachelor_degree_feman_in' => Yii::t('models', 'ຈຳ​ນວນ​​ຜູ້​ຍີງຈົບ​ປະ​ລີນ​ຍາຕີນ​ພາຍ​ໃນ'),
            'bachelor_degree_man_out' => Yii::t('models', 'ຈຳ​ນວນ​​ຜູ້​ຊາຍຈົບ​ປະ​ລີນ​ຍາຕີນ​ຕ່າງ​ປະ​ເທດ'),
            'bachelor_degree_feman_out' => Yii::t('models', 'ຈຳ​ນວນ​​ຜູ້​ຍີງຈົບ​ປະ​ລີນ​ຍາຕີນ​ຕ່າງ​ປະ​ເທດ'),

            'bachelor_man_in' => Yii::t('models', 'ຈຳ​ນວນ​​ຜູ້​ຊາຍຈົບ​ຊັ້ນ​ສ​ູງ ຫຼື ທຽບ​ເທົ່າ ​ພາຍ​ໃນ'),
            'bachelor_feman_in' => Yii::t('models', 'ຈຳ​ນວນ​​ຜູ້​ຍີງຈົບ​ຊັ້ນ​ສ​ູງ ຫຼື ທຽບ​ເທົ່າ ​ພາຍ​ໃນ'),
            'bachelor_man_out' => Yii::t('models', 'ຈຳ​ນວນ​​ຜູ້​ຊາຍຈົບ​ຊັ້ນ​ສ​ູງ ຫຼື ທຽບ​ເທົ່າ ​ຕ່າງ​ປະ​ເທດ'),
            'bachelor_feman_out' => Yii::t('models', 'ຈຳ​ນວນ​​ຜູ້​ຍີງຈົບ​ຊັ້ນ​ສ​ູງ ຫຼື ທຽບ​ເທົ່າ ​ຕ່າງ​ປະ​ເທດ'),

            'middle_diploma_man_in' => Yii::t('models', 'ຈຳ​ນວນ​​ຜູ້​ຊາຍຈົບ​ຊັ້ນ​ກາງ​ພາຍ​ໃນ'),
            'middle_diploma_feman_in' => Yii::t('models', 'ຈຳ​ນວນ​​ຜູ້​ຍີງຈົບ​ຊັ້ນກາງ​ພາຍ​ໃນ'),
            'middle_diploma_man_out' => Yii::t('models', 'ຈຳ​ນວນ​​ຜູ້​ຊາຍຈົບ​ຊັ້ນ​ກາງ​ຕ່າງ​ປະ​ເທດ'),
            'middle_diploma_feman_out' => Yii::t('models', 'ຈຳ​ນວນ​​ຜູ້​ຍີງຈົບ​ຊັ້ນ​ກາງ​ຕ່າງ​ປະ​ເທດ'),

            'lower_diploma_man_in' => Yii::t('models', 'ຈຳ​ນວນ​​ຜູ້​ຊາຍຈົບ​ຊັ້ນ​ຕົ້ນ​ພາຍ​ໃນ'),
            'lower_diploma_feman_in' => Yii::t('models', 'ຈຳ​ນວນ​​ຜູ້​ຍີງຈົບ​ຊັ້ນ​ຕົ້ນ​ພາຍ​ໃນ'),
            'lower_diploma_man_out' => Yii::t('models', 'ຈຳ​ນວນ​​ຜູ້​ຊາຍຈົບ​ຊັ້ນ​ຕົ້ນ​ຕ່າງ​ປະ​ເທດ'),
            'lower_diploma_feman_out' => Yii::t('models', 'ຈຳ​ນວນ​​ຜູ້​ຍີງຈົບ​ຊັ້ນ​ຕົ້ນ​ຕ່າງ​ປະ​ເທດ'),
            'ministry_id' => Yii::t('models', 'ກະ​ຊວງ'),
        ]
    );
    }
}
