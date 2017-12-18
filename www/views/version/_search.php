<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VersionSeach */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="version-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'v_major') ?>

    <?= $form->field($model, 'v_minor') ?>

    <?= $form->field($model, 'v_patch') ?>

    <?= $form->field($model, 'v_realpatch') ?>

    <?= $form->field($model, 'v_tag') ?>

    <?php // echo $form->field($model, 'v_database') ?>

    <?php // echo $form->field($model, 'v_acl') ?>

    <?php // echo $form->field($model, 'id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
