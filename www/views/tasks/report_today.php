<?php

use yii\helpers\Html;

$this->title = 'Day Report';
$this->params['breadcrumbs'][] = $this->title;
$heading = array(
    'Date',
    'Bug No.',
    'Priority',
    'Start Time',
    'End Time',
  //  'Project *',
    'Action',
    'Task',
    'Hrs Worked',
    'Status',
    'Comments',
);

function seconds($time)
{
    $time = explode(':', $time);
    return ($time[0] * 3600) + ($time[1] * 60) + $time[2];
}

?>
<div class="container-fluid tasks-report">
    <h1><?= Html::encode($this->title) ?></h1>
    <div style="float:left;">
		<?= Html::a('Create Tasks', null, ['class' => 'btn btn-success', 'id' => 'new-task']) ?>		
        <input type="button" value="Copy" class="btn btn-sm btn-primary" onclick="selectElementContents(document.getElementById('mailContent'));">
		<input type="button" value="Copy 2" class="btn btn-sm btn-primary" onclick="selectElementContents(document.getElementById('shortreport'));">
        <?= Html::a('Download', Yii::$app->getUrlManager()->getBaseUrl() . '?r=tasks/dayreport&csv=1&date='.$_GET['date'], ['class' => 'btn btn-sm btn-primary']); ?>
		<?= Html::a('Download Full', Yii::$app->getUrlManager()->getBaseUrl() . '?r=tasks/dayreport&csv=1&full=1&date='.$_GET['date'], ['class' => 'btn btn-sm btn-primary']); ?>
		<?= Html::a('Edit', Yii::$app->getUrlManager()->getBaseUrl() . '?r=tasks/index&fdate=' . $_GET['date'], ['class' => 'btn btn-sm btn-danger']) ?>
    </div>
	<div style="float:right;font-weight:bold;margin-bottom:25px;">
		<table>
			<tr>
			<th>This Month&nbsp;:&nbsp;</th>
			<td><?php echo $this_month;?> hrs</td>
			<th>&nbsp;&nbsp;&nbsp;Last Month&nbsp;:&nbsp;</th>
			<td><?php echo $last_month;?> hrs</td>
			<th>&nbsp;&nbsp;&nbsp;Before Last Month&nbsp;:&nbsp;</th>
			<td><?php echo $before_month;?> hrs</td>
			</tr>
		</table>
	</div>
    <br/>
    <div id="mailContent">
        <table style="width:100%;">
            <!--<tr>
                <td></td>                
                <td></td>
                <td></td>
                <td></td>
                <td></td>
				<td><strong>NAME</strong></td>
                <td><strong>BALASUNDARAM M</strong></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
			<tr>
                <td></td>                
                <td></td>
                <td></td>
                <td></td>
                <td></td>
				<td><strong>Project</strong></td>
                <td><strong>iMedicor (iCoreConnect)</strong></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>-->            
            <tr> <?php foreach ($heading as $head) { ?> <td><strong><?php echo $head; ?></strong></td><?php } ?>	</tr>
<?php
$total_hrs = 0;
$count = 0;
foreach ($dataProvider->models as $model) {

    ?> 
                <tr> 
                    <td style="width:120px;"><?php if ($count++ == 0) echo date("m/d/Y", strtotime($model->date)); ?></td>
                    <td><?php echo $model->bug_no; ?></td>
                    <td><?php echo $priorityList[$model->priority]; ?></td>
                    <td><?php echo date("H:i", strtotime($model->start_time)); ?></td>
                    <td><?php echo date("H:i", strtotime($model->end_time)); ?></td>		
                    <!--<td><?php echo $model->project; ?></td>-->
                    <td><?php echo $model->module; ?></td>
                    <td><?php echo $model->work_details; ?></td>
                    <td><?php echo $model->hours_number;
                    $total_hrs+=$model->hours_number;

                    ?></td>
                    <td><?php echo $statusList[$model->status]; ?></td>
                    <td><?php echo nl2br($model->comments); ?></td>
<?php } ?>	
            </tr>
            <tr> <?php for ($i = 1; $i <= 10; $i++) { ?> <td>&nbsp;&nbsp;&nbsp;</td><?php } ?>	</tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <!--<td></td>-->
            <td><strong>Total Hrs</strong></td>
            <td><strong><?php echo number_format($total_hrs,2); ?></strong></td>
            <td></td>
            <td></td>
        </table>
    </div>
</div>

<div class="modal fade" id="modal" style="width:100%;" role="dialog" aria-labelledby="modalLabel" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document" style="width:1200px;">
		<div class="modal-content" style="width:100%;" >
		</div>
	</div>
</div>
<style>
    td{
        border: 1px solid;
        padding:5px 10px;
    }
</style>
<script type="text/javascript">
    function selectElementContents(el) {
        var body = document.body, range, sel;
        if (document.createRange && window.getSelection) {
            range = document.createRange();
            sel = window.getSelection();
            sel.removeAllRanges();
            try {
                range.selectNodeContents(el);
                sel.addRange(range);
            } catch (e) {
                range.selectNode(el);
                sel.addRange(range);
            }
        } else if (body.createTextRange) {
            range = body.createTextRange();
            range.moveToElementText(el);
            range.select();
        }
    }

</script>

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
    .field-tasks-start_time, 
	.field-tasks-hours_number{
        float:left;
        width:15%;
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
	.filter-div a, .filter-div input{float:left;margin-left:5px;float:left;}
</style>
<script type="text/javascript">
function goTaskReportItems(date){
	window.location.href="<?php echo Yii::$app->getUrlManager()->getBaseUrl() . '?r=tasks&fdate=';?>"+date;
}
</script>








<!--- NEW --->
<br/><br/><br/>
    <div id="shortreport">
        <table style="width:100%;">           
<?php
$total_hrs = 0;
$count = 0;
foreach ($dataProvider->models as $model) {

    ?> 
                <tr> 
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;- <?php echo $model->bug_no?$model->bug_no.' ':''; ?><?php echo nl2br($model->comments)==''?$model->work_details:nl2br($model->comments); ?></td>
				</tr>  
<?php } ?>	
                                  
        </table>
    </div>