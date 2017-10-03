<?php
$connect=mysqli_connect('sql308.byethost11.com','b11_18001806','eshu@123');
if(mysqli_connect_errno()) 
die("couldnt connect to server");
mysqli_select_db($connect,"b11_18001806_dbms") or die('couldnt connect to the database');

$connect->query('SET foreign_key_checks = 0');
if ($result = $connect->query("SHOW TABLES"))
{
    while($row = $result->fetch_array(MYSQLI_NUM))
    {
        $connect->query('DROP TABLE IF EXISTS '.$row[0]);
    }
}
$sql="CREATE TABLE ANALYSISa(ticker VARCHAR(10) PRIMARY KEY,daysincint FLOAT,pctofdaysinc FLOAT,avgincpct FLOAT,daysdec FLOAT,pctofdaysdec FLOAT,avgdecpct FLOAT,buckysellvalue FLOAT,buckybuyvalue FLOAT)";
$connect->query($sql);
$connect->query('SET foreign_key_checks = 1');
$connect->close();
echo "done<br><a href=form.php>click here to start new</a>";
?>


