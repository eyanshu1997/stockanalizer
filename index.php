<?php
session_start();
if($_SESSION["user"])
header('location: form.php');
?>
	<!DOCTYPE html>
<html>
<style>
* {
  box-sizing: border-box;
}
body {
  margin: 0;
background-color: #dee4ed;
}

/* Style the header */
.header {
    background-color: #f1f1f1;
    text-align: center;
}
@media (max-width: 600px) {
    .column.side, .column.middle {
        width: 100%;
    }
}

/* Style the footer */
.footer {
    background-color: #f1f1f1;
    padding: 10px;
    text-align: center;
}
input[type=text], input[type=password] , input[type=email] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}


button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}




.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}


.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 60px;
}

.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

.close {
    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-size: 35px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: red;
    cursor: pointer;
}


.animate {
    -webkit-animation: animatezoom 0.6s;
    animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
    from {-webkit-transform: scale(0)} 
    to {-webkit-transform: scale(1)}
}
    
@keyframes animatezoom {
    from {transform: scale(0)} 
    to {transform: scale(1)}
}
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}

@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
.row:after {
    content: "";
    display: table;
    clear: both;
}

</style>
<body>
<div class="row" style="background-color: white;">
<div class="header">
<a href="index.php"> <img src="banner.png" height=44% width=100%></a>
</div>
</div>
<div class="row" style="background-color: white; width: 70%; margin: auto">
<p>
<center><h2>
Wall Street analyser is a personalized stock manager with a great experience, and efficient algorithm.<br>
Sign up or login for the experience.</h2>
</center>
</p>
</div>
<div class="row" style="background-color: white; width: 70%; margin: auto">
<center>

<button onclick="document.getElementById('id01').style.display='block'" >Login</button>
<button onclick="document.getElementById('id02').style.display='block'" >Sign Up</button>
</center>
</div>

<div id="id01" class="modal">
  
  <form class="modal-content animate" action=submit11.php method=post>
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      
    </div>
	

    <div class="container">
      <label><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name = "email" required>

      <label><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name = "password" required>
        
      <button type="submit">Login</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>
</div>
<div id="id02" class="modal">
  <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
      <form class="modal-content animate" action="submit.php" method=post>
    <div class="container">
	<label><b>First Name</b></label>
	<input type="text" placeholder="Enter First Name Here.." name="firstname" >
	<label>Last Name</label>
	<input type="text" placeholder="Enter Last Name Here.." name="lastname" >
	<label>Username</label>
	<input type="text" placeholder="Enter Username" name="username">
							
      <label><b>Email</b></label>
      <input type="email" placeholder="Enter Email" name="email" required>

      <label><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Sign Up</button>
      </div>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
var modal1 = document.getElementById('id02');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal1) {
        modal.style.display = "none";
    }
}
</script>

</body>
</html>

