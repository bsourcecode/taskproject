<?php

use yii\helpers\Html;

$this->title = 'Today Report';
$this->params['breadcrumbs'][] = $this->title;
$heading = array(
    'Date*',
    'Bug No.*',
    'Priority',
    'Start Time',
    'End Time',
  //  'Project *',
    'Module Name / Task Name *',
    'Work Details *',
    'Hrs Worked *',
    'Status *',
    'Comments *',
);

function seconds($time)
{
    $time = explode(':', $time);
    return ($time[0] * 3600) + ($time[1] * 60) + $time[2];
}

?>
<div class="container-fluid tasks-report">
    <h1><?= Html::encode($this->title) ?></h1>
    <div>
        <input type="button" value="Copy" class="btn btn-sm btn-primary" onclick="selectElementContents(document.getElementById('mailContent'));">
        <?= Html::a('Download', Yii::$app->getUrlManager()->getBaseUrl() . '?r=tasks/dayreport&csv=1&date='.$_GET['date'], ['class' => 'btn btn-sm btn-primary']); ?>
		<?= Html::a('Edit', Yii::$app->getUrlManager()->getBaseUrl() . '?r=tasks/index&fdate=' . $_GET['date'], ['class' => 'btn btn-sm btn-danger']) ?>
    </div>
    <br/>
    <div id="mailContent">
        <table style="width:100%;">
            <tr>
                <td></td>                
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <!--<td></td>-->
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
                <!--<td></td>-->
				<td><strong>Project</strong></td>
                <td><strong>iMedicor (iCoreConnect)</strong></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>            
            <tr> <?php foreach ($heading as $head) { ?> <td><strong><?php echo $head; ?></strong></td><?php } ?>	</tr>
<?php
$total_hrs = 0;
$count = 0;
foreach ($dataProvider->models as $model) {

    ?> 
                <tr> 
                    <td style="width:120px;"><?php if ($count++ == 0) echo date("d-M-Y", strtotime($model->date)); ?></td>
                    <td><?php echo $model->bug_no; ?></td>
                    <td><?php echo $priorityList[$model->priority]; ?></td>
                    <td><?php echo date("H:i", strtotime($model->start_time)); ?></td>
                    <td><?php echo date("H:i", strtotime($model->end_time)); ?></td>		
                    <!--<td><?php echo $model->project; ?></td>-->
                    <td><?php echo $model->module; ?></td>
                    <td><?php echo $model->work_details; ?></td>
                    <td><?php echo $model->hours_number;
                    $total_hrs+=seconds($model->hours_worked);

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
            <td><strong><?php echo gmdate("H:i", $total_hrs); ?></strong></td>
            <td></td>
            <td></td>
        </table>
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