<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AttendanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Attendances';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid attendance-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Attendance', ['create'], ['class' => 'btn btn-success pull-left']) ?>
 
	<?php
		echo DatePicker::widget([
			'name'  => 'attendance_month',
			'value'  => isset($_GET['date'])?$_GET['date']:'',
			'dateFormat' => 'yyyy-MM',
			'options' => [
				'class'=> 'form-control',
				'id' => 'attendance_month',
				'onchange'=>'goMonthAttendance($(this).val())',
				'style'=>'margin-top: 10px;width: 100px;margin-left: 160px;'
			],
		]);
	?>   </p>
	<?php 
	global $total_delay;
	$total_delay = "00:00:00"; 
	?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'date',
            'checkin',
            'checkout',
			'checkin2',
            'checkout2',
			[
				'label' => 'Delay Hours',
				'value' => function ($model) {
					return $model->delay_hours != "00:00:00" ?date("H:i", strtotime($model->delay_hours)):"00:00";
					
				}
			],
			[
				'label' => 'Gross Time',
				'value' => function ($model) {
					$datetime1 = date_create($model->checkout);
					$datetime2 = date_create($model->checkin);
					$interval1 = date_diff($datetime1, $datetime2);
					
					$datetime1 = date_create($model->checkout2);
					$datetime2 = date_create($model->checkin2);
					$interval2 = date_diff($datetime1, $datetime2);
					return $interval1->format('%h hr %i mins').' | '.$interval2->format('%h hr %i mins');
				}
			],
			[
				'label' => 'Total',
				'value' => function ($model) {
					global $total_delay;
					if($model->delay_hours=='00:00:00'){
						return $total_delay;
					}
					$secs = strtotime($total_delay)-strtotime("00:00:00");
					return $total_delay = date("H:i:s",strtotime($model->delay_hours)+$secs);
				}
			],
            //'created',
            // 'modified',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<script type="text/javascript">
function goMonthAttendance(date){
	window.location.href="<?php echo Yii::$app->getUrlManager()->getBaseUrl() . '?r=attendance&sort=date&AttendanceSearch[date]=';?>"+date;
}
</script>