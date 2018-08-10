<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Api */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="api-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'url')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'formats')->dropDownList([ 'xml' => 'Xml', 'json' => 'Json', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'http_method')->dropDownList([ 'GET' => 'GET', 'POST' => 'POST', 'DELETE' => 'DELETE', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'parameters')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'prerequisites')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sample_request')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sample_response')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'error_response')->textarea(['rows' => 6]) ?>
	
	<?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
