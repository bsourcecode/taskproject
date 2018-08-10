<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ApiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="api-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'url') ?>

    <?= $form->field($model, 'formats') ?>

    <?php // echo $form->field($model, 'http_method') ?>

    <?php // echo $form->field($model, 'parameters') ?>

    <?php // echo $form->field($model, 'prerequisites') ?>

    <?php // echo $form->field($model, 'notes') ?>

    <?php // echo $form->field($model, 'sample_request') ?>

    <?php // echo $form->field($model, 'sample_response') ?>

    <?php // echo $form->field($model, 'error_response') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
