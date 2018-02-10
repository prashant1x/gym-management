<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif;}
body, html {
    height: 100%;
    color: #777;
    line-height: 1.8;
}

/* Create a Parallax Effect */
.bgimg-1, .bgimg-2, .bgimg-3, .bgimg-4 ,.bgimg-5,.bgimg-6 {
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

/* First image (Logo. Full height) */
.bgimg-1 {
    background-image: url("./images/images.jpg");
    min-height: 100%;
}

/* Second image (Portfolio) */
.bgimg-2 {
    background-image: url("/w3images/parallax2.jpg");
    min-height: 400px;
}

/* Third image (Contact) */
.bgimg-3 {
    background-image: url("/w3images/parallax3.jpg");
    min-height: 400px;
}
/* Fourth image (Login) */
.bgimg-4 {
    background-image: url("./images/download.jpg");
    min-height: 400px;
}
    /* Fivth image (Login) */
.bgimg-5 {
    background-image: url("./images/images.jpg");
    min-height: 400px;
}
/* sixth image (Login) */
.bgimg-5 {
    background-image: url("./images/images.jpg");
    min-height: 400px;
}

.w3-wide {letter-spacing: 10px;}
.w3-hover-opacity {cursor: pointer;}

/* Turn off parallax scrolling for tablets and phones */
@media only screen and (max-device-width: 1024px) {
    .bgimg-1, .bgimg-2, .bgimg-3, .bgimg-4, .bgimg-5 ,.bgimg-6 {
        background-attachment: scroll;
    }
}
</style>
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar" id="myNavbar">
    <a class="w3-bar-item w3-button w3-hover-black w3-hide-medium w3-hide-large w3-right" href="javascript:void(0);" onclick="toggleFunction()" title="Toggle Navigation Menu">
      <i class="fa fa-bars"></i>
    </a>
    <a href="#home" class="w3-bar-item w3-button">HOME</a>
    <a href="#about" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-user"></i> ABOUT</a>
    <a href="#blog" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-user"></i> BLOG</a>
    <a href="#login" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-envelope"></i> LOGIN</a>
    <a href="#new registration" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-envelope"></i>NEW REGISTRATION</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-red">
      <i class="fa fa-search"></i>
    </a>
  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium">
    <a href="#about" class="w3-bar-item w3-button" onclick="toggleFunction()">ABOUT</a>
    <a href="#blog" class="w3-bar-item w3-button" onclick="toggleFunction()">BLOG</a>
       <a href="#login" class="w3-bar-item w3-button" onclick="toggleFunction()">LOGIN</a>
    <a href="#new registration" class="w3-bar-item w3-button" onclick="toggleFunction()">NEW REGISTRATION</a>
    <a href="#" class="w3-bar-item w3-button">SEARCH</a>
  </div>
</div>

<!-- First Parallax Image with Logo Text -->
<div class="bgimg-1 w3-display-container w3-opacity-min" id="home">
  <div class="w3-display-middle" style="white-space:nowrap;">
    <span class="w3-center w3-padding-large w3-black w3-xlarge w3-wide w3-animate-opacity">MY <span class="w3-hide-small">WEBSITE</span> LOGO</span>
  </div>
</div>

<!-- Container (About Section) -->
<div class="w3-content w3-container w3-padding-64" id="about">
  <h3 class="w3-center">ABOUT ME</h3>
  <p class="w3-center"><em>I love photography</em></p>
  <p>We have created a fictional "personal" website/blog, and our fictional character is a hobby photographer. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
    qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
  <div class="w3-row">
    <div class="w3-col m6 w3-center w3-padding-large">
      <p><b><i class="fa fa-user w3-margin-right"></i>My Name</b></p><br>
      <img src="/w3images/avatar_hat.jpg" class="w3-round w3-image w3-opacity w3-hover-opacity-off" alt="Photo of Me" width="500" height="333">
    </div>

    <!-- Hide this text on small devices -->
    <div class="w3-col m6 w3-hide-small w3-padding-large">
      <p>Welcome to my website. I am lorem ipsum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor
        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
  </div>
</div>





<!-- Modal for full size images on click-->
<div id="modal01" class="w3-modal w3-black" onclick="this.style.display='none'">
  <span class="w3-button w3-large w3-black w3-display-topright" title="Close Modal Image"><i class="fa fa-remove"></i></span>
  <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
    <img id="img01" class="w3-image">
    <p id="caption" class="w3-opacity w3-large"></p>
  </div>
</div>          
</div>

<!-- Fourth Parallax Image with Portfolio Text -->
<div class="bgimg-4 w3-display-container w3-opacity-min">
  <div class="w3-display-middle">
     <span class="w3-xxlarge w3-text-white w3-wide">BLOG</span>
  </div>
</div>
</div>

<!-- Container (New Registration Section) -->
<div class="w3-content w3-container w3-padding-64" id="blog">
 <span>
 <head>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("text").click(function(){
        $("#div1").fadeToggle();
        $("#div2").fadeToggle("slow");
        $("#div3").fadeToggle(3000);
    });
});
</script>
</head>
<text>Videos</text><br><br>
<div id="div1" style="width:80px;height:80px;"><iframe width="300" height="200" src="https://www.youtube.com/embed/L77b57erQ4M?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div><br><br><br><br><br><br><br><br>
<div id="div2" style="width:80px;height:80px;"><iframe width="300" height="200" src="https://www.youtube.com/embed/kgNC69CX5M8?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>
<div id="div3" style="width:80px;height:80px;"></div>
 </span>
</div>

<!-- Fourth Parallax Image with Portfolio Text -->
<div class="bgimg-4 w3-display-container w3-opacity-min">
  <div class="w3-display-middle">
     <span class="w3-xxlarge w3-text-white w3-wide">LOGIN</span>
  </div>
</div>
</div>
</div>

<!-- Container (Login Section) -->
<div class="w3-content w3-container w3-padding-64" id="login">
  <h4 class="w3-center">LOGIN</h4>
  <p class="w3-center"><em> <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <form class="form-horizontal" action="/action_page.php">
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-6">
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-6">          
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label><input type="checkbox" name="remember"> Remember me</label>
        </div>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div> </em></p>
  <div class="w3-row w3-padding-32 w3-section">
    <div class="w3-col m4 w3-container">
   </div>
    </div>
    </div>

<!-- Modal for full size images on click-->
<div id="modal01" class="w3-modal w3-black" onclick="this.style.display='none'">
  <span class="w3-button w3-large w3-black w3-display-topright" title="Close Modal Image"><i class="fa fa-remove"></i></span>
  <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
    <img id="img01" class="w3-image">
    <p id="caption" class="w3-opacity w3-large"></p>
  </div>
</div>          
</div>
<div class="bgimg-4 w3-display-container w3-opacity-min">
  <div class="w3-display-middle">
     <span class="w3-xxlarge w3-text-white w3-wide">NEW REGISTRATION</span>
  </div>
</div>

    <!-- Fivth Parallax Image with Portfolio Text -->
<div class="bgimg-3 w3-display-container w3-opacity-min">
  <div class="w3-display-middle">
     <span class="w3-xxlarge w3-text-white w3-wide">NEW REGISTRATION</span>
  </div>
</div>

<!-- Container (New Registration Section) -->
<div class="w3-content w3-container w3-padding-64" id="new registration">
  <h3 class="w3-center"></h3>
  <p class="w3-center"><em></em></p>

  <div class="w3-row w3-padding-32 w3-section">
    <div class="w3-col m4 w3-container">
      </div>
      </div>
      </form>
      </div>
      </div>
      </div>
<!-- Footer -->
<footer class="w3-center w3-black w3-padding-64 w3-opacity w3-hover-opacity-off">
  <a href="#home" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
  <div class="w3-xlarge w3-section">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>
  </div>
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green">w3.css</a></p>
</footer>
 
<!-- Add Google Maps -->
<script>
function myMap()
{
  myCenter=new google.maps.LatLng(41.878114, -87.629798);
  var mapOptions= {
    center:myCenter,
    zoom:12, scrollwheel: false, draggable: false,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  var map=new google.maps.Map(document.getElementById("googleMap"),mapOptions);

  var marker = new google.maps.Marker({
    position: myCenter,
  });
  marker.setMap(map);
}

// Modal Image Gallery
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
  var captionText = document.getElementById("caption");
  captionText.innerHTML = element.alt;
}

// Change style of navbar on scroll
window.onscroll = function() {myFunction()};
function myFunction() {
    var navbar = document.getElementById("myNavbar");
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        navbar.className = "w3-bar" + " w3-card" + " w3-animate-top" + " w3-white";
    } else {
        navbar.className = navbar.className.replace(" w3-card w3-animate-top w3-white", "");
    }
}

// Used to toggle the menu on small screens when clicking on the menu button
function toggleFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu-916DdpKAjTmJNIgngS6HL_kDIKU0aU&callback=myMap"></script>
<!--
To use this code on your website, get a free API key from Google.
Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
-->

</body>
</html>
<?php
echo $GLOBALS['error'];
echo $GLOBALS['success'];
?>

<h2>-- Login Form --</h2>
<form action="<?php echo URL; ?>LoginController/login" method="POST" onsubmit="return validateLogin()">
  Role: <select id="roleL" name="role" >
    <option value="">--select--</option>
    <option value="U">Member</option>
    <option value="T">Trainer</option>
    <option value="M">Manager</option>
  </select><br />
  Email: <input type="text" id="emailidL" name="email" /><br />
  Password: <input type="password" id="passwordL" name="password" /><br />
  <input type="submit" value="Login" /><br />
</form>

<h2>-- Registration Form --</h2>
<form action="<?php echo URL; ?>RegistrationController/register" method="POST" onsubmit="return validateRegistration()">
  Role: <select name="role" id="role" onchange="onRoleSelect()">
    <option value="">--select--</option>
    <option value="U">Member</option>
    <option value="T">Trainer</option>
    <option value="M">Manager</option>
  </select><br />
  Name: <input type="text" id="name" name="name" /><br />
  Address: <input type="text" id="address" name="address" /><br />
  Phone: <input type="text" id="phone" name="phone" /><br />
  Email: <input type="text" id="emailid" name="email" /><br />
  Password: <input type="password" id="password" name="password" /><br />
  <div id="U" style="display: none;">
  Gender: <input type="text" id="genderU" name="genderU" /><br />
  Age: <input type="text" id="age" name="age" /><br />
  Weight: <input type="text" id="weight" name="weight" /><br />
  Height: <input type="text" id="height" name="height" /><br />
  </div>
  <div id="T" style="display: none;">
  Gender: <input type="text" id="genderT" name="genderT" /><br />
  Experience: <input type="text" id="experience" name="experience" /><br />
  </div>
  <div id="M" style="display: none;">
  Qualification: <input type="text" id="qualification" name="qualification" /><br />
  </div>
  <input type="submit" value="Register" /><br />
</form>

<script>
  function onRoleSelect() {
    document.getElementById("U").style.display = 'none';
    document.getElementById("T").style.display = 'none';
    document.getElementById("M").style.display = 'none';
    var role = document.getElementById("role").value;
    if (role && role.toString().trim().length > 0) {
      document.getElementById(role.toString().trim()).style.display = 'block';
    }
  }

  function isNullOrEmpty(val) {
    console.log(val);
    return ((val == void 0) || (val == null) || (val.toString().trim().length == 0));
  }

  function getValue(elem) {
    try {
      return document.getElementById(elem).value;
    } catch (e) {
      console.error(e);
    }
    return null;
  } 

  function validateRegistration() {
    var role = getValue('role');
    var name = getValue('name');
    var address = getValue('address');
    var phone = getValue('phone');
    var email = getValue('emailid');
    var password = getValue('password');
    var genderU = getValue('genderU');
    var genderT = getValue('genderT');
    var age = getValue('age');
    var weight = getValue('weight');
    var height = getValue('height');
    var experience = getValue('experience');
    var qualification = getValue('qualification');
    if (isNullOrEmpty(role)) {
      alert('Please select role');
      return false;
    }
    if (isNullOrEmpty(name) || isNullOrEmpty(email) || isNullOrEmpty(phone) || isNullOrEmpty(address) || isNullOrEmpty(password)) {
      alert('Please complete the form 1');
      return false;
    }
    switch (role) {
      case 'U': 
        if (isNullOrEmpty(genderU) || isNullOrEmpty(age) || isNullOrEmpty(weight) || isNullOrEmpty(height)) {
          alert('Please complete the form 2');
          return false;
        }
        break;
      case 'T':
        if (isNullOrEmpty(genderT) || isNullOrEmpty(experience)) {
          alert('Please complete the form 3');
          return false;
        }
        break;
      case 'M':
        if (isNullOrEmpty(qualification)) {
          alert('Please complete the form 4');
          return false;
        }
        break;
      default:
        alert('Invalid role');
        break;
        return false;
    }
    return true;
  }

  function validateLogin() {
    var role = getValue("roleL");
    var email = getValue("emailidL");
    var pwd = getValue("passwordL");
    if (isNullOrEmpty(role) || isNullOrEmpty(email) || isNullOrEmpty(pwd)) {
      alert('Please fill all details for Login');
      return false;
    }
    return true;
  }
</script>
