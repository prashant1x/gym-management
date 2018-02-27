<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
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


