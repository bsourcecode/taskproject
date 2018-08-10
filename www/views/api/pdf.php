<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Api */
?>
<h1>Cypher API Service</h1>
<style>
.navbar-inverse, .breadcrumb, .btn, .footer{display:none;}
.table > tbody > tr > th, .table > tbody > tr > td{border:none;}
</style>
<ul style="list-style:none;">
<?php foreach($pdfmodel as $model){ ?>
<li><strong><a href="#<?php echo $model->title;?>"><?= Html::encode($model->title) ?></a></strong></li>
<?php } ?>
</ul>
<?php foreach($pdfmodel as $model){ ?>
<div class="api-view">

    <h2 id="<?php echo $model->title;?>"><?= Html::encode($model->title) ?></h2>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'title',            
            'url:pre',
			'description:html',
            'formats',
            'http_method',
            'parameters:html',
            'prerequisites:html',
            //'notes:html',
            'sample_request:pre',
            'sample_response:pre',
            'error_response:pre',
        ],
    ]) ?>	
</div>
<?php } ?>