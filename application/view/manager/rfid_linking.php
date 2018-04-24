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
if (isset($GLOBALS['UserList']) && sizeof($GLOBALS['UserList']) > 0) {
?>
        <p class="center" style="font-weight: bold; color: red; font-size: 20px;">User List</p>
        <br />
        <div class="container">
        <div class="row">
    <div class="col-sm">
        <table class="table table-bordered">
            <tr>
                <th>Sr no.</th>
                <th>User Name</th>
                <th>Email Id</th>
                <th>Select RFID</th>
            </tr>
<?php
    $userList = $GLOBALS['UserList'];
    for ($i = 0, $l = sizeof($userList); $i < $l; $i++) {
        $user = $userList[$i];
        echo '<tr>'
        . '<td>' . ($i + 1) . '</td>'
        . '<td>' . $user->getName() . '</td>'
        . '<td>' . $user->getEmail() . '</td>';
        if (isset($GLOBALS['RFIDList']) && sizeof($GLOBALS['RFIDList']) > 0) {
            $rfidList = $GLOBALS['RFIDList'];
            echo '<td>';
?>
            <form action="<?php echo URL;?>RFIDController/assign" method="POST">
                <input type="hidden" id="<?php echo $i;?>" name="user_id" value="<?php echo $user->getId();?>" />
                <select id="<?php echo 's' . $i;?>" name="id">
<?php
            for ($j = 0, $k = sizeof($rfidList); $j < $k; $j++) {
                $rfid = $rfidList[$j];
                echo '<option value="' . $rfid->getId() . '">' . $rfid->getCardId() . '</option>';
            }
?>                    
                </select>
                <input type="submit" value="Link" />
            </form>
<?php
            echo '</td>';
        } else {
            echo '<td>No RFID available</td>';
        }
        echo '</tr>';
    }
?>
        </table>
		</div>
		</div>
		</div>
<?php
} else {
    echo "<center>No Users found.</center>";
}
?>
    </body>
</html>