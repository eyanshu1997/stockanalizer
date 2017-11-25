<?php
//show analysis.php
$connect=mysqli_connect('sql308.byethost11.com','b11_18001806','eshu@123');
if(mysqli_connect_errno()) 
die("couldnt connect to server");
mysqli_select_db($connect,"b11_18001806_dbms") or die('couldnt connect to the database');
main();
mysqli_close($connect);
?>
<html>
<head>
<style>
table 
{
    border-collapse: collapse;
    width: 100%;
}
th, td {
    text-align: left;
    padding: 8px;
}
tr:nth-child(even) {background-color: #f2f2f2;}
tr:hover {background-color:#80fc8b;}
input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
</style>
</head>
<body>
<?php
include("includes/db.php");
function display($ticker)
{
	$connect=mysqli_connect('sql308.byethost11.com','b11_18001806','eshu@123');
	if(mysqli_connect_errno()) 
	die("couldnt connect to server");
	mysqli_select_db($connect,"b11_18001806_dbms") or die('couldnt connect to the database');
        $sql="SELECT * FROM ANALYSISa WHERE ticker='$ticker'";
	$result = mysqli_query($connect,$sql);
	if(!$result)
	{
		echo "<center><a href=analysis_a.php>click here to create record for $ticker</a><br> no record found</center>";
	}
	else
	{
		$x=mysqli_num_rows($result);
		if($x=='0')
		{
			echo "<center><a href=analysis_a.php>click here to create record</a><br> no record found</center>";
		}
		while($row = mysqli_fetch_array($result))
		{
			//ticker,daysincint,pctofdaysinc,avgincpct,daysdec,pctofdaysdec,avgdecpct,buckysellvalue,buckybuyvalue
			echo "<tr>";
			echo "<td>" . $row['ticker'] . "</td>";
			echo "<td>" . $row['daysincint'] . "</td>";
			echo "<td>" . $row['pctofdaysinc'] . "</td>";
			echo "<td>" . $row['avgincpct'] . "</td>";
			echo "<td>" . $row['daysdec'] . "</td>";
			echo "<td>" . $row['pctofdaysdec'] . "</td>";
			echo "<td>" . $row['avgdecpct'] . "</td>";
			echo "<td>" . $row['buckysellvalue'] . "</td>";
			echo "<td>" . $row['buckybuyvalue'] . "</td>";
			echo "</tr>";
		}
	}
}
function main()
{
session_start();
if(!$_SESSION["user"])
header('location: index.php');
$e=$_SESSION["user"];
	echo "<table border='1'>
	<tr>
	<th>code of company</th>
	<th>no of days the stock increased</th>
	<th>percentage of days the stock increased</th>
	<th>averages of increases per day</th>
	<th>no of days the stock decreased</th>
	<th>percentage of days the stock decreased</th>
	<th>averages of increases per day</th>
	<th>percentage of days the stock increases*average of percentage of increases</th>
	<th>percentage of days the stock decreases*average of percentage of decrease</th>
	</tr>";
	$connect=mysqli_connect('sql308.byethost11.com','b11_18001806','eshu@123');
	if(mysqli_connect_errno()) 
	die("couldnt connect to server");
	mysqli_select_db($connect,"b11_18001806_dbms") or die('couldnt connect to the database');
	$s="SELECT * FROM com where username='$e'";
	$result = mysqli_query($connect,$s);
	while($row = mysqli_fetch_array($result))
	{
		$companyticker=$row['code'];
		$companyticker=trim($companyticker);
		display($companyticker);
	}
	echo "</table></center>";
}
?>
</body>
</html>