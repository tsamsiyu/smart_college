<?php
/* @var array $messagesByPulpit */
/* @var array $messagesByDirection */

use yii\web\JqueryAsset;

JqueryAsset::register($this);

$this->title = 'Отчеты';

?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {

        var messagesInfo = <?= \yii\helpers\Json::encode($messagesByPulpit) ?>;
        messagesInfo.unshift(['Task', 'Messages by pulpits']);
        var data = google.visualization.arrayToDataTable(messagesInfo);
        var options = {
            title: 'Распределенность количества отправленных сообщений по кафедрам'
        };
        var chart = new google.visualization.PieChart(document.getElementById('messages-by-pulpits'));
        chart.draw(data, options);

        messagesInfo = <?= \yii\helpers\Json::encode($messagesByDirection) ?>;
        console.log(messagesInfo);
        messagesInfo.unshift(['Task', 'Messages by directions']);
        data = google.visualization.arrayToDataTable(messagesInfo);
        options = {
            title: 'Распределенность количества отправленных сообщений по факультетам кафедр'
        };
        chart = new google.visualization.PieChart(document.getElementById('messages-by-directions'));
        chart.draw(data, options);

    }
</script>

<div>
    <div id="messages-by-directions" style="margin: 0 auto; width: 900px; height: 500px;"></div>
    <div id="messages-by-pulpits" style="margin: 0 auto; width: 900px; height: 500px;"></div>
</div>