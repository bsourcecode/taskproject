<?php

use yii\helpers\Html;

$this->title = 'Tomorrow Report';
$this->params['breadcrumbs'][] = $this->title;
$heading = array(
    'Work Plan for Tomorrow (29 Aug 2017)*',
    'Est. Hrs.',
);

?>
<div class="container-fluid tasks-report">
    <h1>
        <?= Html::encode($this->title) ?>
        <input type="button" value="Copy" onclick="selectElementContents(document.getElementById('mailContent'));">
    </h1>
    <div id="mailContent">
        <table style="width:600px;">
            <tr>
                <th colspan=2>Work Plan for Tomorrow (<?php echo date("d M Y", strtotime(date("Y-m-d") . " +1 day")); ?>)*</th>
                <th>Est. Hrs.</th>
            </tr>
            <?php
            $sno = 1;
            foreach ($dataProvider->models as $model) {

                ?>
                <tr>
                    <td><?php echo $sno++; ?></td>
                    <td><?php echo $model->work_details; ?></td>
                    <td><?php echo date("H:i", strtotime($model->estimated_hours)); ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
<style>
    td, th{
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