<?php
session_start();

$u=$_POST["email"];
$v = $_POST["password"];
$p=md5($v);

$con=mysqli_connect('sql308.byethost11.com','b11_18001806','eshu@123','b11_18001806_dbms');
    if (mysqli_connect_errno($con)) 
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    
   $sql = "SELECT * FROM SignUp WHERE Username ='$u' AND Password = '$p'";
   $result=mysqli_query($con,$sql);
   if($result)
   {
   
 
   if(mysqli_num_rows($result)==0)
   {
   	echo "login failed";
   }
   else
   {
   	if(mysqli_num_rows($result)==1)
   	{
		$_SESSION["user"]=$u;
   		header('Location: form.php');
   	}
   	else
   	{
   		echo "error";
   	}
   }
  }
else
   	echo"unsucessfulresult";
   ?>
