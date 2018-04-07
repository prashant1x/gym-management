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

if (isset($GLOBALS['FeeStructureList']) && sizeof($GLOBALS['FeeStructureList']) > 0) {
?>
        <p class="center" style="font-weight: bold; color: red; font-size: 20px;">Fees Structure</p>
        <br />
        <table class="center">
            <tr>
                <th>Duration</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
<?php
    $feeStructureList = $GLOBALS['FeeStructureList'];
    $durations = array(1 => "Monthly", 3 => "Quarterly", 6 => "Half Yearly", 12 => "Yearly");
    for ($i = 0, $l = sizeof($feeStructureList); $i < $l; $i++) {
        $feeStructure = $feeStructureList[$i];
?>
            <form method="POST" action="<?php echo URL;?>FeesController/updateFeeStructure" onsubmit="return validateSalary('<?php echo $feeStructure->getDuration();?>')">
<?php
        echo '<tr>'
        . '<td>' . $durations[$feeStructure->getDuration()] . '</td>';
?>
                <td>
                    <input type="text" name="duration" id="id_<?php echo $feeStructure->getDuration();?>" value="<?php echo $feeStructure->getDuration()?>" style="display: none;" />
                    <span id="spn_<?php echo $feeStructure->getDuration();?>"><?php echo $feeStructure->getAmount();?></span>
                    <input type="text" name="amount" id="<?php echo $feeStructure->getDuration();?>" value="<?php echo $feeStructure->getAmount();?>" style="display: none;" />
                </td>
<?php
        echo '</td>'
        . '<td>';
?>
                <button type="button" onclick="showInputText('<?php echo $feeStructure->getDuration();?>')" id="btn_<?php echo $feeStructure->getDuration();?>">Edit</button>
                <input type="submit" value="Modify" style="display: none;" id="sbt_<?php echo $feeStructure->getDuration();?>" />
<?php
        echo '</td>'
        . '</tr>';
?>
            </form>
<?php
    }
?>
        </table>
        <script>
            function showInputText(eid) {
                document.getElementById(eid).style.display = 'block';
                document.getElementById('sbt_' + eid).style.display = 'block';
                document.getElementById('btn_' + eid).style.display = 'none';
                document.getElementById('spn_' + eid).style.display = 'none';
            }

            function validateSalary(eid) {
                if (document.getElementById(eid).value.toString().trim().length === 0) {
                    alert('Please entery amount to modify');
                    return false;
                }
                return true;
            }
        </script>
<?php
}
else {
    echo 'No fees found';
}
?>
<br />
<?php

if(isset($GLOBALS['UserList']) && sizeof($GLOBALS['UserList']) > 0) {
    $userFeeList = $GLOBALS['UserList'];
?>
        <p class="center" style="font-weight: bold; color: red; font-size: 20px;">User List</p>
        <table class="center">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>From Date</th>
                <th>To Date</th>
                <th>Payment Mode</th>
                <th>Payment Date</th>
            </tr>
<?php
    for($i = 0, $l = sizeof($userFeeList); $i < $l; $i++) {
        if (null !== $userFeeList[$i]->getid() && $userFeeList[$i]->getToDate() > date('Y-m-d H:i:s')) {
            echo "<tr>";
        } else {
            echo "<tr style='color: red;'>";
        }
        echo "<td>" . $userFeeList[$i]->getUser()->getName() . "</td>";
        echo "<td>" . $userFeeList[$i]->getUser()->getEmail() . "</td>";
        echo "<td>" . $userFeeList[$i]->getUser()->getPhone() . "</td>";
        echo "<td>" . $userFeeList[$i]->getFromDate() . "</td>";
        echo "<td>" . $userFeeList[$i]->getToDate() . "</td>";
        echo "<td>" . $userFeeList[$i]->getPaymentMode() . "</td>";
        echo "<td>" . $userFeeList[$i]->getPaymentDate() . "</td>";
        echo "</tr>";
    }
?>
        </table>
<?php
}

?>

    </body>
</html>