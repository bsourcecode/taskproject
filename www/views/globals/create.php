<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Globals */

$this->title = 'Create Globals';
$this->params['breadcrumbs'][] = ['label' => 'Globals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container globals-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
