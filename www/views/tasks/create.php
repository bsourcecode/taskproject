<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tasks */

$this->title = 'Create Tasks';
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$model->date = $model->date!=''?$model->date:date("Y-m-d");
?>
<div class="container tasks-create">

    <h1><?= Html::encode($this->title) ?>
	<button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="float:right;"><span aria-hidden="true">×</span></button>
	</h1>

    <?= $this->render('_form', [
        'model' => $model,
		'statusList'=> $statusList,
		'priorityList'=> $priorityList,
        'projectList' => $projectList
    ]) ?>

</div>
