<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Attendance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attendance-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'checkin')->textInput() ?>

    <?= $form->field($model, 'checkout')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
    $this->registerCssFile("@web/jquery.datetimepicker-2.4.1/jquery.datetimepicker.min.css");
    $this->registerJsFile("@web/jquery.datetimepicker-2.4.1/jquery.datetimepicker.min.js", ['depends' => [yii\web\JqueryAsset::className()]]);
    $this->registerJs(
        '
	$(document).ready(function(){
		$( "#attendance-date" ).datetimepicker({format:"Y-m-d",timepicker:false,closeOnDateSelect:true});
		$( "#attendance-checkin" ).datetimepicker({format:"H:i",datepicker:false,step:1,minTime:"00:00",validateOnBlur:true});
		$( "#attendance-checkout" ).datetimepicker({format:"H:i",datepicker:false,step:1,minTime:"00:00",validateOnBlur:false});
	});
	');
?>