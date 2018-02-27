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
        <p class="center" style="font-weight: bold; color: red; font-size: 20px;">Set List</p>
        <br />
        <table class="center">
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
    echo "<center>No sets found.</center>";
}
?>
    </body>
</html>