<?php
if (!empty($_POST['act'])) 
{
	$connect=mysqli_connect('sql308.byethost11.com','b11_18001806','eshu@123');
	if(mysqli_connect_errno()) 
	die("couldnt connect to server");
	mysqli_select_db($connect,"b11_18001806_dbms") or die('couldnt connect to the database');
    $table=$_POST['act'];
	$sql="DROP TABLE $table";
	echo $sql;
	if(mysqli_query($connect,$sql))
	{
		header('location: show.php');
	}
	else
		die("couldn't delete the table");
	
} 
else
{
	echo("<center><a href=analysis_a.php>click here to analize these facts</a></center>");
	echo "<br>";
	echo "<br>";
	main();
}
include("includes/db.php");
function display($ticker)
{
	$connect=mysqli_connect('sql308.byethost11.com','b11_18001806','eshu@123');
	if(mysqli_connect_errno()) 
	die("couldnt connect to server");
	mysqli_select_db($connect,"b11_18001806_dbms") or die('couldnt connect to the database');
	$result = mysqli_query($connect,"SELECT * FROM $ticker");
	if(!$result)
	{
		echo "<center><a href=form.php>click here to create record found for".$ticker."</a><br> no record foundfor ".$ticker."</center>";
	    return;
	}
	echo "<center><b><h1>".$ticker."</h1></b>";
	?>
	<html>
	<body>
	<form action="show.php" method="POST">
    <input type="hidden" name="act" value=<?php echo $ticker ?> >
    <input type="submit" value="delete">
    </form>
	</body>
	</html>
	<?
	echo "<table border='1'>
	<tr>
	<th>Date</th>
	<th>Open</th>
	<th>High</th>
	<th>Low</th>
	<th>Close</th>
	<th>Volume</th>
	<th>amount_change</th>
	<th>percent_change</th>
	</tr>";
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
		echo "<td>" . $row['Date'] . "</td>";
		echo "<td>" . $row['Open'] . "</td>";
		echo "<td>" . $row['High'] . "</td>";
		echo "<td>" . $row['Low'] . "</td>";
		echo "<td>" . $row['Close'] . "</td>";
		echo "<td>" . $row['Volume'] . "</td>";
		echo "<td>" . $row['amount_change'] . "</td>";
		echo "<td>" . $row['percent_change'] . "</td>";
		echo "</tr>";
	}
	echo "</table></center>";
}
function main()
{
	$maintickerfile= fopen("tickermaster.txt","r");
	while(!feof($maintickerfile))
	{
		$companyticker=fgets($maintickerfile);
		$companyticker=trim($companyticker);
		display($companyticker);
	}
}
?>