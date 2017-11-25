<?php
function display($ticker,$edate,$sdate)
{
	$connect=mysqli_connect('sql308.byethost11.com','b11_18001806','eshu@123');
	if(mysqli_connect_errno()) 
	die("couldnt connect to server");
	mysqli_select_db($connect,"b11_18001806_dbms") or die('couldnt connect to the database');
	$result = mysqli_query($connect,"SELECT * FROM $ticker");
	if(!$result)
	{
		echo "<center><a href=form.php>click here to create record found for".$ticker."</a><br> no record foundfor ".$ticker."</center>";
		die();
	    return;
	}
	echo "<center ><b><h1>".$ticker."</h1></b>";
	echo "<table border='1'>
	<tr>
	<th>Date</th>";
	if(isset($_POST['Open']) &&   $_POST['Open'] == 'Yes')
	{
		echo "<th>Open</th>";
	}
	if(isset($_POST['High']) &&   $_POST['High'] == 'Yes')
	{
		echo "<th>High</th>";
	}
	if(isset($_POST['Low']) &&   $_POST['Low'] == 'Yes')
	{
		echo "<th>Low</th>";
	}
	if(isset($_POST['Close']) &&   $_POST['Close'] == 'Yes')
	{
		echo "<th>Close</th>";
	}
	if(isset($_POST['Volume']) &&   $_POST['Volume'] == 'Yes')
	{
		echo "<th>Volume</th>";
	}
	if(isset($_POST['amount_change']) &&   $_POST['amount_change'] == 'Yes')
	{
		echo "<th>amount_change</th>";
	}
	if(isset($_POST['percent_change']) &&   $_POST['percent_change'] == 'Yes')
	{
		echo "<th>percent_change</th>";
	}
	echo "</tr>";
	while($row = mysqli_fetch_array($result))
	{
		if($row['Date']>$sdate and $row['Date'] < $edate)
		{
			echo "<tr>";
			echo "<td>" . $row['Date'] . "</td>";
			if(isset($_POST['Open']) &&   $_POST['Open'] == 'Yes')
			{
				echo "<td>" . $row['Open'] . "</td>";
			}
			if(isset($_POST['High']) &&   $_POST['High'] == 'Yes')
			{
				echo "<td>" . $row['High'] . "</td>";
			}
			if(isset($_POST['Low']) &&   $_POST['Low'] == 'Yes')
			{
				echo "<td>" . $row['Low'] . "</td>";
			}
			if(isset($_POST['Close']) &&   $_POST['Close'] == 'Yes')
			{
				echo "<td>" . $row['Close'] . "</td>";
			}
			if(isset($_POST['Volume']) &&   $_POST['Volume'] == 'Yes')
			{
	
				echo "<td>" . $row['Volume'] . "</td>";
			}
			if(isset($_POST['amount_change']) &&   $_POST['amount_change'] == 'Yes')
			{

				echo "<td>" . $row['amount_change'] . "</td>";
			}
			if(isset($_POST['percent_change']) &&   $_POST['percent_change'] == 'Yes')
			{

				echo "<td>" . $row['percent_change'] . "</td>";
			}
			echo "</tr>";
		}
	}
	echo "</table></center>";
}
if($_POST['Sub'])
{
	if(!$_POST['code'] or !$_POST['edate']or !$_POST['sdate'])
	{
		echo "input all variable";
		die();
	}
	if($edate<$sdate)
	{
		echo "end date before start date";
		die();
	}
	session_start();
	if(!$_SESSION["user"])
	header('location: index.php');
	$code=$_POST['code'];
	$edate=$_POST['edate'];
	$sdate=$_POST['sdate'];
	?>
	<!DOCTYPE html>
	<html>
	<head>
	<style>
	table 
	{
		border-collapse: collapse;
		width: 100%;
	}
	th, td 
	{
		text-align: left;
		padding: 8px;
	}
	tr:nth-child(even) {background-color: #f2f2f2;}
	tr:hover {background-color:#80fc8b;}
	input[type=submit] 
	{
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
	<center>
	<form method=post action=ichart.php target="_blank" >
	<input type=hidden name=code value="<?php echo $code?>"><br>
	<input type=hidden name=sdate value="<?php echo $sdate?>"><br>
	<input type=hidden name=edate value = "<?php echo $edate ?>">
	<input type="submit" name="formSubmit" value="get chart" />
	</form>
	</center>
	<?php
	display($code,$edate,$sdate);
	die();	
}	