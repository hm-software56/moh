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
        'class' => 'navbar-default  navbar-fixed-top',
    ],
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => (Yii::$app->user->id)?[
        ['label' => Yii::t('app', 'ປ້ອນບົດສະເໜີໂຄງການ'),'url' => ['project-proposal-year/index']],
        (Yii::$app->user->identity->type=="Admin")?['label' => Yii::t('app', 'ຕັ້ງ​ຄ່າ'),
            'items' => [
                ['label' => 'ຈັດ​ການ​ພະ​ແນກ', 'url' => ['department/index']],
                ['label' => 'ຈັດ​ການ​ຜູ້​ໃຊ້​ລະ​ບົບ', 'url' => ['user/index']],
                ['label' => 'ຈັດ​ການ​ກໍານົດວັນທີ່ສົ່ງ', 'url' => ['submittion-dead-line/index']],
            ],
            
        ]:'',
        
        (Yii::$app->user->id)?['label' => Yii::t('app', 'ອອກ​ຈາກ​ລະ​ບົບ'),'url' => ['site/logout']]:'',

    ]:[],
]);
NavBar::end();
?>

    <div class="container">
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
