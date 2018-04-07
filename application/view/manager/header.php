<?php

require_once(APP . 'model/FeesModel.php');

$userFeeList = FeesModel::getUserList();

$defaulters = 0;
for($i = 0, $l = sizeof($userFeeList); $i < $l; $i++) {
  if ((null !== $userFeeList[$i]->getid() && $userFeeList[$i]->getToDate() < date('Y-m-d H:i:s')) || null === $userFeeList[$i]->getId()) {
      $defaulters++;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <style>
    .badge {
      padding: 1px 9px 2px;
      font-size: 12.025px;
      font-weight: bold;
      white-space: nowrap;
      color: #ffffff;
      background-color: #999999;
      -webkit-border-radius: 9px;
      -moz-border-radius: 9px;
      border-radius: 9px;
    }
    .badge-error {
      background-color: #b94a48;
    }

  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="<?php echo URL . 'LoginController/login'?>"><?php echo $_SESSION['UNAME']?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo URL . 'TrainerController'?>">Trainer Mgmt.</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo URL . 'RFIDController'?>">RFID Mgmt.</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo URL?>FeesController">Fees Mgmt.<?php echo $defaulters > 0 ? "<span class='badge badge-error'>$defaulters</spam>" : "" ;?></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo URL?>LoginController/logout">Logout</a>
      </li>    
    </ul>
  </div>  
</nav>
<br>

<div class="container">
  <h3>Welcome <?php echo $_SESSION['UNAME']?></h3>
</div>

</body>
</html>


