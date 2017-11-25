<?php


$first=$_POST["firstname"];
$last=$_POST["lastname"];
$user=$_POST["username"];
$password=$_POST["password"];
$email=$_POST["email"];
$p=md5($password);

    $con=mysqli_connect('sql308.byethost11.com','b11_18001806','eshu@123','b11_18001806_dbms');
    if (mysqli_connect_errno($con)) 
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

$sq = "SELECT * FROM SignUp WHERE Username ='$user' ";

$result=mysqli_query($con,$sq);
if(mysqli_num_rows($result))
{
   	echo "username already exists retry again";
die();
}	


    $sql="INSERT INTO SignUp(`First_Name`,`Last_name`,`Username`,`Password`,`email`) VALUES('$first','$last','$user','$p','$email')";

$result = mysqli_query($con,$sql) ;

if($result)
{
	echo "Successful redirecting ......";
  echo '<script language="javascript">';
  echo 'alert("Successful")';  //not showing an alert box.
  echo '</script>';
        header('Refresh: 3; URL=http://stockmanager.byethost11.com/stock/index.php');
}
else
{
	echo "Retry user not created";
}


?>
