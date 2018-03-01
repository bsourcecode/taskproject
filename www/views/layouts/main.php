<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\jui\DatePicker;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Task Report',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
	echo DatePicker::widget([
			'name'  => 'from_date',
			'value'  => isset($_GET['date'])?$_GET['date']:'',
			'dateFormat' => 'yyyy-MM-dd',
			'options' => [
				'class'=> 'form-control',
				'id' => 'report-pick',
				'onchange'=>'goTaskReport($(this).val())',
				'style'=>'margin-top: 10px;width: 100px;float: right;margin-left: 20px;'
			],
		]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
			['label' => 'Tasks', 'url' => ['/tasks','fdate'=>date("Y-m-d")]],
            ['label' => 'Report: Today', 'url' => ['/tasks/dayreport','date'=>date("Y-m-d")]],
            ['label' => 'Report: Yesterday', 'url' => ['/tasks/dayreport','date'=>date("Y-m-d", strtotime(date("Y-m-d ") . " -1 day"))]],
            ['label' => 'Plan: Tomorrow', 'url' => ['/tasks/tomorrow']],
			['label' => 'Attendance', 'url' => ['/attendance']],
            ['label' => 'Globals', 'url' => ['/globals']]
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container-fluid">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container-fluid">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>
<script type="text/javascript">
function goTaskReport(date){
	window.location.href="<?php echo Yii::$app->getUrlManager()->getBaseUrl() . '?r=tasks%2Fdayreport&date=';?>"+date;
}
</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
