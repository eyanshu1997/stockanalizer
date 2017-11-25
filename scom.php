<?php
session_start();
if(!$_SESSION["user"])
header('location: index.php');
echo "welcome";
$e=$_SESSION["user"];
echo $e;
$c=$_POST["code"];
$con=mysqli_connect('sql308.byethost11.com','b11_18001806','eshu@123','b11_18001806_dbms');
    if (mysqli_connect_errno($con)) 
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
 $sql="INSERT INTO com(username,code) VALUES('$e','$c')";

 $query=mysqli_query($con,$sql);
if($query)
echo "successful";
else
echo " error";
?>