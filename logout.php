<?php
session_start();
unset($_SESSION["user"]); 
echo " logged out  redirecting.......";
header('Refresh: 3; URL=http://stockmanager.byethost11.com/stock/');

?>