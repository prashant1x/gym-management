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

if (isset($GLOBALS['TrainerList']) && sizeof($GLOBALS['TrainerList']) > 0) {
?>
        <p class="center" style="font-weight: bold; color: red; font-size: 20px;">Trainer List</p>
        <br />
        <table class="center">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Gender</th>
                <th>Experience</th>
                <th>Salary</th>
                <th>Action</th>
            </tr>
<?php
    $trainerList = $GLOBALS['TrainerList'];
    for ($i = 0, $l = sizeof($trainerList); $i < $l; $i++) {
        $trainer = $trainerList[$i];
?>
            <form method="POST" action="<?php echo URL;?>TrainerController/setSalary" onsubmit="return validateSalary('<?php echo $trainer->getId();?>')">
<?php
        echo '<tr>'
        . '<td>' . $trainer->getId() . '</td>'
        . '<td>' . $trainer->getName() . '</td>'
        . '<td>' . $trainer->getPhone() . '</td>'
        . '<td>' . $trainer->getAddress() . '</td>'
        . '<td>' . $trainer->getGender() . '</td>'
        . '<td>' . $trainer->getExperience() . '</td>';
?>
                <td>
                    <input type="text" name="trainerId" id="id_<?php echo $trainer->getId();?>" value="<?php echo $trainer->getId()?>" style="display: none;" />
                    <span id="spn_<?php echo $trainer->getId();?>"><?php echo $trainer->getSalary()?></span>
                    <input type="text" name="salary" id="<?php echo $trainer->getId();?>" value="<?php echo $trainer->getSalary()?>" style="display: none;" />
                </td>
<?php
        echo '</td>'
        . '<td>';
?>
                <button type="button" onclick="showInputText('<?php echo $trainer->getId();?>')" id="btn_<?php echo $trainer->getId();?>">Edit</button>
                <input type="submit" value="Modify" style="display: none;" id="sbt_<?php echo $trainer->getId();?>" />
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
                    alert('Please entery salary to modify');
                    return false;
                }
                return true;
            }
        </script>
<?php
}
else {
    echo 'No trainers found';
}
?>
    </body>
</html>