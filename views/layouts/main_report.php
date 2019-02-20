<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>">
<head>
    <meta charset="<?=Yii::$app->charset?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?=Html::csrfMetaTags()?>
    <title><?=Html::encode($this->title)?></title>
    <?php $this->head()?>
</head>
<body>
<?php $this->beginBody()?>

<div class="wrap">
    <?php
NavBar::begin([
    'brandLabel' => Yii::t('app','​ລະ​ບົບ​ເກັບ​ກຳສະຖິຕິໂຄງ​ການ'),
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-default  navbar-top',
    ],
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => (Yii::$app->user->id)?[
        ['label' => Yii::t('app', 'ໂຄງການ'),'url' => ['project/index']],
        ['label' => Yii::t('app', 'ປ້ອນບົດສະເໜີໂຄງການ'),'url' => ['project-proposal-year/index']],
        ['label' => Yii::t('app', 'ລາຍ​ງານ'),
            'items' => [
                ['label' => 'ລາຍ​ງານບົດສະເໜີໂຄງການຂອງ​ກົມ', 'url' => ['project-proposal-year/reportexternal']],
                ['label' => 'ລາຍ​ງານ​ສັງ​ລວມ​ກາ​ນ​ຍົກ​ລະ​ດັບ​ຂອງ​ກະ​ຊວງ', 'url' => ['employee-level/report']],
            ],
            
        ],
        (Yii::$app->user->identity->type!="Admin")?['label' => Yii::t('app', 'ຂໍ້​ມູນ​ສ່ວນ​ຕົວ'),'url' => ['user/profile']]:'',

        (Yii::$app->user->identity->type=="Admin")?['label' => Yii::t('app', 'ຕັ້ງ​ຄ່າ'),
            'items' => [
                ['label' => 'ບໍ​ລິ​ຫານ​ກົມ', 'url' => ['department/index']],
                '<li class="divider"></li>',
                ['label' => 'ບໍລິ​ຫານ​ຜູ້​ໃຊ້​ລະ​ບົບ', 'url' => ['user/index']],
                '<li class="divider"></li>',
                ['label' => 'ກຳ​ນົດ​ວັນ​ທີ່​ສົ່ງ​ບົດ​ໂຄງ​ການ', 'url' => ['submittion-dead-line/index']],
                '<li class="divider"></li>',
                ['label' => 'ບໍລິ​ຫານປະ​ເພດ​ໂຄງ​ການ', 'url' => ['project-type/index']],
                '<li class="divider"></li>',
                ['label' => 'ບໍລິ​ຫານສະ​ຖາ​ນະໂຄງ​ການ', 'url' => ['project-status/index']],
                '<li class="divider"></li>',
                ['label' => 'ບໍລິ​ຫານກຸ່ມ​ປະ​ເພດ​ໂຄງ​ການ', 'url' => ['group-project-type/index']],
            ],
            
        ]:'',
        
        (Yii::$app->user->id)?['label' => Yii::t('app', 'ອອກ​ຈາກ​ລະ​ບົບ')."(".Yii::$app->user->identity->first_name.")",'linkOptions' => ['style' => 'color:red;'],'url' => ['site/logout']]:'',
        

    ]:[],
]);
NavBar::end();
?>

    <div class="container-fluid">
        <?=Breadcrumbs::widget([
            'homeLink' => ['label' =>Yii::t('app','ໜ້າຫຼັກ'),'url'=>['site/index']],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
])?>
        <?=Alert::widget()?>
        <?=$content?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?=date('Y')?></p>

        <p class="pull-right"><?=Yii::powered()?></p>
    </div>
</footer>

<?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>
