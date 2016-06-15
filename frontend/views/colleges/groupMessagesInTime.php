<?php
/* @var array $msgGroup */
/* @var array $msgPulpit */

use yii\web\JqueryAsset;
use yii\helpers\Json;

JqueryAsset::register($this);

$this->title = 'Отчеты';
?>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var msgGroup = <?= Json::encode($msgGroup) ?>;
        var data = google.visualization.arrayToDataTable(msgGroup);
        var options = {
            title: 'График изменения активности отправки сообщений студентами',
            curveType: 'function'
        };
        var chart = new google.visualization.LineChart(document.getElementById('group_chart'));
        chart.draw(data, options);

        msgGroup = <?= Json::encode($msgPulpit) ?>;
        data = google.visualization.arrayToDataTable(msgGroup);
        options = {
            title: 'График изменения активности отправки сообщений преподавателями',
            curveType: 'function'
        };
        chart = new google.visualization.LineChart(document.getElementById('pulpit_chart'));
        chart.draw(data, options);
    }
</script>


<div>
    <div id="group_chart" style="width: 1400px; height: 700px"></div>
    <div id="pulpit_chart" style="width: 1400px; height: 700px"></div>
</div>