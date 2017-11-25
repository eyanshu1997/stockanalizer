<?php
require_once('as-diagrams.php');
session_start();
if(!$_SESSION["user"])
header('location: index.php');
$user=$_SESSION["user"];
$t1=$_POST['select'];
$t2=$_POST['select2'];
$edate=$_POST['edate'];
$sdate=$_POST['sdate'];
display($t1,$t2,$edate,$sdate);
function display($t1,$t2,$edate,$sdate)
{
	$tc1=array();
	$tc2=array();
	$date=array();
	?>
	<html>
	<head>
	<title>
	</title>
	</head>
	<body>
	<center>
	<?php
	$connect=mysqli_connect('sql308.byethost11.com','b11_18001806','eshu@123');
	if(mysqli_connect_errno()) 
	die("couldnt connect to server");
	mysqli_select_db($connect,"b11_18001806_dbms") or die('couldnt connect to the database');
        $s1="SELECT * FROM $t1";
	$result = mysqli_query($connect,$s1);
	if(!$result)
	{
		echo "<center><a href=form.php>click here to create record found for".$t1."</a><br> no record foundfor ".$t1."</center>";
	    return;
	}
       $s2="SELECT * FROM $t2";
	$result2 = mysqli_query($connect,$s2);
	if(!$result2)
	{
		echo "<center><a href=form.php>click here to create record found for".$t2."</a><br> no record foundfor ".$t2."</center>";
	    return;
	}

	
$i=0;
	while($row = mysqli_fetch_array($result))
	{
		if($row['Date']>$sdate and $row['Date'] < $edate)
		{
$date[$i]=$row['Date'];
			$tc1[$i]= $row['Close']; 
  
$i++;
		}
	}
$i=0;
	while($row1= mysqli_fetch_array($result2))
	{
		if($row1['Date']>$sdate and $row1['Date'] < $edate)
		{
			$tc2[$i]= $row1['Close']; 
  
$i++;
		}
	}
$i=0;
$d1=array();
while($tc1[$i]&&$tc2[$i])
{
          $d[$i]=array($tc1[$i],$tc2[$i]);
$i++;
}
$data = array();
foreach($d as $x)
{
$data[] = $x;

}
$legend_y = array($t1,$t2);
$legend_x = $date;
$data_title = $t1." and ".$t2;
$graph = new CAsBarDiagram;
$graph->bwidth = 10; // set one bar width, pixels
$graph->bt_total = 'Summary'; // 'totals' column title, if other than 'Totals'
$graph->showtotals = 0;  // uncomment it if You don't need 'totals' column
$graph->precision = 0;  // decimal precision
// call drawing function
$graph->DiagramBar($legend_x, $legend_y, $data, $data_title);
	?>
	
	</body>
	</html>
	<?php
}

?>	
			