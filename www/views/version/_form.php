<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Version */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="version-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'v_major')->textInput() ?>

    <?= $form->field($model, 'v_minor')->textInput() ?>

    <?= $form->field($model, 'v_patch')->textInput() ?>

    <?= $form->field($model, 'v_realpatch')->textInput() ?>

    <?= $form->field($model, 'v_tag')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'v_database')->textInput() ?>

    <?= $form->field($model, 'v_acl')->textInput() ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
