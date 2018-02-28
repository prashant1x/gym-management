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
if (isset($GLOBALS['RepsList']) && sizeof($GLOBALS['RepsList']) > 0) {
?>
        <p class="center" style="font-weight: bold; color: red; font-size: 20px;">Reps List</p>
        <br />
        <table class="center">
            <tr>
                <th>No.</th>
                <th>Set Id</th>
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
    echo "<center>No reps found.</center>";
}
?>
    </body>
</html>