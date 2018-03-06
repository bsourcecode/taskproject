<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui;

/* @var $this yii\web\View */
/* @var $model app\models\Tasks */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="tasks-form">

    <?php $form = ActiveForm::begin(["id" => "tasks-form"]); ?>
	
	<?= $form->field($model, 'checkin')->checkBox(['style' => 'width:90%;']) ?>

    <?= $form->field($model, 'date')->textInput(['style' => 'width:90%;']) ?>

    <?= $form->field($model, 'bug_no')->textInput(['style' => 'width:90%;']) ?>

    <?= $form->field($model, 'status')->dropDownList($statusList, ['prompt' => 'Choose...', 'style' => 'width:90%;']) ?>

    <?= $form->field($model, 'position')->textInput(['type' => 'number', 'style' => 'width:90%;']) ?>

    <?= $form->field($model, 'priority')->dropDownList($priorityList, ['prompt' => 'Choose...', 'style' => 'width:90%;']) ?>

    <?= $form->field($model, 'project')->dropDownList($projectList, ['style' => 'width:90%;']) ?>

    <?= $form->field($model, 'module')->dropDownList($model->getAction(),['style' => 'width:90%;']) ?>

    <?= $form->field($model, 'estimated_hours')->textInput(['style' => 'width:90%;']) ?>

    <?= $form->field($model, 'start_time')->textInput(['style' => 'width:90%;']) ?>

    <?= $form->field($model, 'end_time')->textInput(['style' => 'width:90%;']) ?>

    <?= $form->field($model, 'adj_time')->textInput(['style' => 'width:90%;']) ?>

    <?= $form->field($model, 'hours_worked')->textInput(['style' => 'width:90%;']) ?>
	
	<?= $form->field($model, 'hours_number')->textInput(['type' => 'number', 'style' => 'width:90%;']) ?>

    <?= $form->field($model, 'work_details')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'comments')->textarea(['rows' => 6]) ?>

    <div class="form-group">
<?= Html::Button($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-new' : 'btn btn-primary btn-edit']) ?>
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
    </div>

<?php ActiveForm::end(); ?>

</div>