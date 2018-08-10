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

<?php 
$this->registerCssFile('@web/fullcalendar-scheduler-1.9.4/lib/fullcalendar.min.css');
$this->registerCssFile('@web/fullcalendar-scheduler-1.9.4/lib/fullcalendar.print.min.css');

$this->registerJsFile('@web/fullcalendar-scheduler-1.9.4/lib/moment.min.js', ['depends' => 'yii\web\JqueryAsset']);
//$this->registerJsFile('@web/fullcalendar-scheduler-1.9.4/lib/jquery.min.js');
$this->registerJsFile('@web/fullcalendar-scheduler-1.9.4/lib/fullcalendar.min.js', ['depends' => 'yii\web\JqueryAsset']);
?>

<div class="container-fluid attendance-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	<div class="col-sm-2">
    <div id='external-events'>
      <h4>Draggable Events</h4>
      <div class='fc-event'>My Event 1</div>
      <div class='fc-event'>My Event 2</div>
      <div class='fc-event'>My Event 3</div>
      <div class='fc-event'>My Event 4</div>
      <div class='fc-event'>My Event 5</div>
      <p>
        <input type='checkbox' id='drop-remove' />
        <label for='drop-remove'>remove after drop</label>
      </p>
    </div>
	</div>
	<div class="col-sm-10">
    <div id='calendar'></div>
	</div>

    <div style='clear:both'></div>
</div>

<?php
    $this->registerJs(
        "

    $('#external-events .fc-event').each(function() {

      // store data so the calendar knows to render an event upon drop
      $(this).data('event', {
        title: $.trim($(this).text()), // use the element's text as the event title
        stick: true // maintain when user navigates (see docs on the renderEvent method)
      });

      // make the event draggable using jQuery UI
      $(this).draggable({
        zIndex: 999,
        revert: true,      // will cause the event to go back to its
        revertDuration: 0  //  original position after the drag
      });

    });


    /* initialize the calendar
    -----------------------------------------------------------------*/

    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      editable: true,
      droppable: true, // this allows things to be dropped onto the calendar
      drop: function() {
        // is the 
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the 
          $(this).remove();
        }
      }
    });


");?>


<style>

  #external-events {
    float: left;
    width: 100%;
    padding: 0 10px;
    border: 1px solid #ccc;
    background: #eee;
    text-align: left;
  }

  #external-events h4 {
    font-size: 16px;
    margin-top: 0;
    padding-top: 1em;
  }

  #external-events .fc-event {
    margin: 10px 0;
    cursor: pointer;
  }

  #external-events p {
    margin: 1.5em 0;
    font-size: 11px;
    color: #666;
  }

  #external-events p input {
    margin: 0;
    vertical-align: middle;
  }

  #calendar {
    float: right;
    width: 100%;
  }

</style>