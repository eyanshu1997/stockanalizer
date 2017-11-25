<?php	
echo "Successful please wait redirecting to login page";
  echo '<script language="javascript">';
  echo 'alert("Successful")';  //not showing an alert box.
  echo '</script>';
header('Refresh: 3; URL=http://stockmanager.byethost11.com/stock/login1.php');

?>