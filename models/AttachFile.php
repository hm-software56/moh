<?php

namespace app\models;

use Yii;
use \app\models\base\AttachFile as BaseAttachFile;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "attach_file".
 */
class AttachFile extends BaseAttachFile
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
                [['name'], 'required','message'=>Yii::t('app','ທ່ານ​ຕ້ອງ​ເລືອກ​ໄຟ​ຣ​ອັບ​ໂຫຼດ')],
                [['name'], 'safe'],
                [['name'], 'file', 'extensions'=>'jpg, png, doc, docx, pdf','wrongExtension'=>Yii::t('app','ທ່ານ​ມີ​ສິດ​ອັບ​ໂຫຼດ​ໄຟ​ຣ​ປະ​ເພດນີ້').' {extensions}'],
            ],
            parent::rules()
        );
    }
}
