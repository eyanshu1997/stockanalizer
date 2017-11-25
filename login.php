<?php
session_start();
if($_SESSION["user"])
header('location: form.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>

<link rel="stylesheet" type="text/css" href="bb.css">
<link rel="stylesheet" type="text/css" href="bootstrap.css">
<body>
	<style>
	body{
		background: url('books.jpeg');
	}

   </style>
	<div class="container">
    <h1 class="well">Login</h1>
	<div class="col-lg-12 well">
	<div class="row">
				<form method="post" action=submit11.php>
					<div class="col-sm-12">
						
						<div class="row">
							<div class ="col-sm-12 form-group">
								<label>username</label>
								<input type="email" name = "email" placeholder="Enter Your Email-id" class="form-control" required>
							</div>
						</div>	
							<div class ="col-sm-12 form-group row">
								<label>Password</label>
								<input type="password" name = "password" placeholder="Enter Password" class="form-control" required>
							</div>
							<div class ="col-sm-12 form-group row">
								
								<input type="submit" class="btn btn-lg btn-info">
							</div>
						</div>
				</form>					
						
				</div>
	</div>
	</div>

</body>
</html>`
