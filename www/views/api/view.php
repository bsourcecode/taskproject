<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Api */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Apis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if(isset($_GET['pdf'])){ ?>
<style>
#w1, .breadcrumb, .btn, .footer{display:none;}
.table > tbody > tr > th, .table > tbody > tr > td{border:none;}
</style>
<?php } ?>
<div class="api-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('PDF', ['view', 'id' => $model->id, 'pdf'=>''], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

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