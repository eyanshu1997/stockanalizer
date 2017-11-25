<?php
session_start();
if(!$_SESSION["user"])
header('location: index.php');

$e=$_SESSION["user"];
$code=$_POST["code"];
$con=mysqli_connect('sql308.byethost11.com','b11_18001806','eshu@123','b11_18001806_dbms');
	if (mysqli_connect_errno($con)) 
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
		$sql="DELETE FROM com(username,code) VALUES('$e','$code')";
			$query=mysqli_query($con,$sql);
			if($query)
			{
				echo '<script language="javascript">';
				echo 'alert("Successful")';  //not showing an alert box.
				echo '</script>';
 			}
?>