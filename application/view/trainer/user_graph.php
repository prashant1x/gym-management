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
?>

<?php
if (isset($GLOBALS['UserList']) && sizeof($GLOBALS['UserList'])) {
?>
        <div class="center">
            <form id="searchForm" name="searchForm" method="post" action="<?php echo URL;?>TrainerController/getUserGraph">
                Select User: <select id="userId" name="userId" onchange="submitForm()">
                    <option value="">--select--</option>
<?php
    for($i = 0, $l = sizeof($GLOBALS['UserList']); $i < $l; $i++) {
        if (isset($_POST['userId']) && $_POST['userId'] == $GLOBALS['UserList'][$i]->getId()) {
            echo "<option value='" . $GLOBALS['UserList'][$i]->getId() . "' selected>" . $GLOBALS['UserList'][$i]->getName() . "</option>";    
        } else {
            echo "<option value='" . $GLOBALS['UserList'][$i]->getId() . "'>" . $GLOBALS['UserList'][$i]->getName() . "</option>";
        }
    }
?>
                </select>
            </form>
        </div>
        <br />
<?php
}
?>
<?php
if (isset($GLOBALS['RepsList']) && sizeof($GLOBALS['RepsList']) > 0) {
?>
        <p class="center" style="font-weight: bold; color: red; font-size: 20px;">Sets List</p>
        <br />
        <table class="center">
            <tr>
                <th>No.</th>
                <th>Slot Id</th>
                <th>Count</th>
                <th>Start Time</th>
                <th>End Time</th>
            </tr>
<?php
    $repsList = $GLOBALS['RepsList'];
    for ($i = 0, $l = sizeof($repsList); $i < $l; $i++) {
        $reps = $repsList[$i];
        echo '<tr>'
        . '<td>' . ($i + 1) . '</td>'
        . '<td>' . $reps->getSet()->getId() . '</td>'
        . '<td>' . $reps->getCount() . '</td>'
        . '<td>' . $reps->getStartTime() . '</td>'
        . '<td>' . $reps->getEndTime() . '</td>'
        . '</tr>';
    }
?>
        </table>
<?php
} else {
    if (isset($_POST['userId'])) {
        echo "<center>No reps found.</center>";
    }
}
if (isset($GLOBALS['RepsData'])) {
    $repsData = $GLOBALS['RepsData'];
}
?>

    <canvas id="myChart"></canvas>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script>
        var dayOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        dayOfWeek = dayOfWeek.reverse();
        var days = <?php echo json_encode($repsData[0]);?>;
        days = days.reverse();
        var counts = <?php echo json_encode($repsData[1]);?>;
        counts = counts.reverse();
        var data = [];
        var labels = [];
        var day = Number(days[0]);
        for (i = 0; i < 7; i++) {
            labels.push(dayOfWeek[(day + i - 1) % 7]);
            data.push(counts[i] === void 0 ? 0 : counts[i]);
        }
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            data: {
                labels: labels.reverse(),
                datasets: [{
                    label: "Sets Per Day",
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: data.reverse(),
                }]
            },

            // Configuration options go here
            options: {}
        });

        function submitForm() {
            var userId = document.getElementById('userId').value;
            if (userId != "") {
                document.getElementById('searchForm').submit();
            }
        }
    </script>
    </body>
</html>