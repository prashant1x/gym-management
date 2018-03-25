<!Doctype>
<html>
    <head>
        <style>
            table, th, td {
                border: 1px solid black;
                text-align: center;
            }
            .center {
                margin: auto;
                text-align: center;
                width: 45%;
            }
        </style>
    </head>
    <body>
<?php
if (isset($GLOBALS['error']))
    echo $GLOBALS['error'];
if (isset($GLOBALS['success']))
    echo $GLOBALS['success'];
if (isset($GLOBALS['SetList']) && sizeof($GLOBALS['SetList']) > 0) {
?>
        <p class="center" style="font-weight: bold; color: red; font-size: 20px;">Slots List</p>
        <br />
        <table id="sets" class="center">
            <tr>
                <th>No.</th>
                <th>Start Time</th>
                <th>End Time</th>
            </tr>
<?php
    $setList = $GLOBALS['SetList'];
    for ($i = 0, $l = sizeof($setList); $i < $l; $i++) {
        $set = $setList[$i];
        echo '<tr>'
        . '<td><a href="' . URL . 'SetController/getReps/' . $set->getId() . '">' . ($i + 1) . '</a></td>'
        . '<td>' . $set->getStartTime() . '</td>'
        . '<td>' . $set->getEndTime() . '</td>'
        . '</tr>';
    }
?>
        </table>
<?php
} else {
    echo "<center>No slots found.</center>";
}
?>
<div id="info"></div>
<center><div class="chart-container" style="position: relative; height:50%; width:80% ">
<canvas id="bar-chart"></canvas>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script>
    function showTableData() {
        document.getElementById('info').innerHTML = "";
        var myTab = document.getElementById('sets');

        // LOOP THROUGH EACH ROW OF THE TABLE AFTER HEADER.
        for (i = 1; i < myTab.rows.length; i++) {

            // GET THE CELLS COLLECTION OF THE CURRENT ROW.
            var objCells = myTab.rows.item(i).cells;

            // LOOP THROUGH EACH CELL OF THE CURENT ROW TO READ CELL VALUES.
            for (var j = 0; j < objCells.length; j++) {
                info.innerHTML = info.innerHTML + ' ' + objCells.item(j).innerHTML;
            }
            info.innerHTML = info.innerHTML + '<br />';     // ADD A BREAK (TAG).
        }
    }
    showTableData();
function dashedBorder(chart, dataset, data, dash) {

// edit the .draw() function
chart.config.data.datasets[dataset]._meta[0].data[data].draw = function() {
    chart.chart.ctx.setLineDash(dash);
    Chart.elements.Rectangle.prototype.draw.apply(this, arguments);
    Chart.defaults.global.elements.rectangle.borderWidth = 2;

    // put the line style back to the default value
    chart.chart.ctx.setLineDash([1,0]);
}
}
new Chart(document.getElementById("bar-chart"), {
    type: 'bar',
    data: {
      labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
      datasets: [
        {
          label: "Population (millions)",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
          data: [2478,5267,734,784,433]
        }
      ]
    },
    options: {
        
      legend: { display: false },
      title: {
        display: true,
        drawonchartarea: true,
        
        text: 'Predicted world population (millions) in 2050'
      }
    }
});

</script>
</center></div>
    </body>
</html>