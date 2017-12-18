<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Attendance(s)';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="container tasks-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div>
        <strong>Filter : </strong>
        <?= Html::a('All', Yii::$app->getUrlManager()->getBaseUrl() . '?r=tasks/index', ['class' => 'btn btn-sm btn-primary']) ?>
        <?= Html::a('Today', Yii::$app->getUrlManager()->getBaseUrl() . '?r=tasks/index&fdate=' . date("Y-m-d"), ['class' => 'btn btn-sm btn-primary']) ?>
        <?= Html::a('Tomorrow', Yii::$app->getUrlManager()->getBaseUrl() . '?r=tasks/index&fdate=' . date("Y-m-d", strtotime(date("Y-m-d ") . " +1 day")), ['class' => 'btn btn-sm btn-primary']) ?>
        <?= Html::a('Yesterday', Yii::$app->getUrlManager()->getBaseUrl() . '?r=tasks/index&fdate=' . date("Y-m-d", strtotime(date("Y-m-d ") . " -1 day")), ['class' => 'btn btn-sm btn-primary']) ?>
    </div>
    <br/>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'date',
            'start_time',
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', "#", [
                                'class' => "update-btn",
                                'url' => $url
                        ]);
                    },
                    ],
                ],
            ],
        ]);

        ?>
    </div>
    <div class="modal fade" id="modal" style="width:100%;" role="dialog" aria-labelledby="modalLabel" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document" style="width:1200px;">
            <div class="modal-content" style="width:100%;" >
            </div>
        </div>
    </div>
    </div>
    <?php
    $this->registerCssFile("@web/jquery.datetimepicker-2.4.1/jquery.datetimepicker.min.css");
    $this->registerJsFile("@web/jquery.datetimepicker-2.4.1/jquery.datetimepicker.min.js", ['depends' => [yii\web\JqueryAsset::className()]]);
    $this->registerJs(
        '
	$(document).ready(function(){
		
	$("body").on("hidden.bs.modal", ".modal", function () {
                    $(this).removeData("bs.modal");
                });
				
	$(document).on("click","#new-task",function(e){
        $("#modal").modal({
            remote: "' . Yii::$app->getUrlManager()->getBaseUrl() . '?r=tasks/create"
        });
    }); 
	
	$(document).on("click", ".update-btn", function (e) {
		$("#modal").modal({
            remote: $(this).attr("url")
        });
	});
	
	$("#modal").on("loaded.bs.modal", function (e) {
		var adj_time = $("#tasks-adj_time").val();
		if(adj_time==""){adj_time = "00:00";}
		
		var start_time = $("#tasks-start_time").val();
		if(start_time==""){
			start_time = "00:00";
		}
		
		var end_time = $("#tasks-end_time").val();
		if(end_time==""){end_time = "00:00";}
		
		var hours_worked = $("#tasks-hours_worked").val();
		if(hours_worked==""){hours_worked = "00:00";}
		
		var estimated_hours = $("#tasks-estimated_hours").val();
		if(estimated_hours==""){estimated_hours = "00:00";}
		
		$( "#tasks-date" ).datetimepicker({format:"Y-m-d",timepicker:false,closeOnDateSelect:true});
		$( "#tasks-adj_time" ).datetimepicker({format:"H:i",datepicker:false,step:15,minTime:"00:00",maxTime:"03:00", value:adj_time,validateOnBlur:false});
		$( "#tasks-start_time" ).datetimepicker({format:"H:i",datepicker:false,step:15,minTime:"9:00", value:start_time,validateOnBlur:false});
		$( "#tasks-end_time" ).datetimepicker({format:"H:i",datepicker:false,step:15,minTime:"9:00", value:end_time,validateOnBlur:false});
		$( "#tasks-hours_worked" ).datetimepicker({format:"H:i",datepicker:false,step:15, value:hours_worked,validateOnBlur:false});
		$( "#tasks-estimated_hours" ).datetimepicker({format:"H:i",datepicker:false,step:15, value:estimated_hours,validateOnBlur:false});
		
		$("#tasks-start_time, #tasks-end_time, #tasks-adj_time").on("change", function(){
			TimeDifference();
		});
		$(".xdsoft_datetimepicker").trigger("afterOpen.xdsoft"); 

	});
	
       $(document).on("click", ".btn-new, .btn-edit", function (e) {
		    $(".form-group").removeClass("has-error");
			$(".help-block").empty();
            var form = $("#tasks-form");
            // submit form
            $.ajax({
            url    : form.attr("action"),
            type   : "POST",
			dataType: "JSON",
            data   : form.serialize(),
            success: function (response) 
            {
				if(Object.keys(response).length>0){
					$.each(response, function(index, value){
						$(".field-tasks-"+index).addClass("has-error");
						$(".field-tasks-"+index+" .help-block").html(value[0]);
						//console.log(index, value);
					});
				}else{
					$("#modal").modal("toggle");
                     location.reload();
				}
            },
            error  : function () 
            {
                
            }
            });
            return false;
         });
				
	
	function TimeDifference(){

	var first= $( "#tasks-end_time" ).val().split(":")
    var second = $( "#tasks-start_time" ).val().split(":")    
	var adj = $( "#tasks-adj_time" ).val().split(":");
	var newTime = TimeDiff(first, second).split(":");
	console.log(newTime, adj);
	TimeDiff(newTime, adj);
	
	}
function TimeDiff(first, second)
{
	
        
        var xx;
        var yy;
        
        if(parseInt(first[0]) < parseInt(second[0])){          
            
            if(parseInt(first[1]) < parseInt(second[1])){
                
                yy = parseInt(first[1]) + 60 - parseInt(second[1]);
                xx = parseInt(first[0]) + 24 - 1 - parseInt(second[0])
            
            }else{
              yy = parseInt(first[1]) - parseInt(second[1]);
              xx = parseInt(first[0]) + 24 - parseInt(second[0])
            }
           
        
        
        }else if(parseInt(first[0]) == parseInt(second[0])){
        
          if(parseInt(first[1]) < parseInt(second[1])){
                
                yy = parseInt(first[1]) + 60 - parseInt(second[1]);
                xx = parseInt(first[0]) + 24 - 1 - parseInt(second[0])
            
            }else{
              yy = parseInt(first[1]) - parseInt(second[1]);
              xx = parseInt(first[0]) - parseInt(second[0])
            }
        
        }else{
            
            
          if(parseInt(first[1]) < parseInt(second[1])){
                
                yy = parseInt(first[1]) + 60 - parseInt(second[1]);
                xx = parseInt(first[0]) - 1 - parseInt(second[0])
            
            }else{
              yy = parseInt(first[1]) - parseInt(second[1]);
              xx = parseInt(first[0]) - parseInt(second[0])
            }
        
        
        }    
 
    if(xx < 10)
        xx = "0" + xx
        
    
    if(yy < 10)
        yy = "0" + yy
	if(!$.isNumeric(xx)){
		xx="00";
	}
	if(!$.isNumeric(yy)){
		yy="00";
	}
	$( "#tasks-hours_worked" ).val(xx + ":" + yy);
    return xx + ":" + yy;  
}

	});
	'
    );

    ?>

<style type="text/css">
    .field-tasks-estimated_hours,
    .field-tasks-hours_worked,
    .field-tasks-adj_time,
    .field-tasks-end_time,
    .field-tasks-start_time{
        float:left;
        width:19%;
    }

    .field-tasks-position,
    .field-tasks-date,
    .field-tasks-bug_no,
    .field-tasks-priority,
    .field-tasks-project,
    .field-tasks-module,
    .field-tasks-status{
        float:left;
        width:24%;
    }
    .field-tasks-priority, .field-tasks-work_details, .field-tasks-estimated_hours{clear:both;}
    .xdsoft_time.xdsoft_disabled{display:none;}
	.field-tasks-checkin label{width: 85px;text-align: right;color: red;}
	.field-tasks-checkin input{width: 5px !important;float: left;}
</style>