<?
session_start();
if(!$_SESSION["user"])
header('location: index.php');
$user=$_SESSION["user"];
$code=$_POST['code'];
$edate=$_POST['edate'];
$sdate=$_POST['sdate'];
$hostdb = "sql308.byethost11.com"; 
$userdb = "b11_18001806"; 
$passdb = "eshu@123";
$namedb = "b11_18001806_dbms"; 

$dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb);


if ($dbhandle->connect_error) 
{
	exit("There was an error with your connection: ".$dbhandle->connect_error);
}
$strQuery = "SELECT * FROM  $code ";
$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");
$i=0;
if ($result) 
{
	$date=array();
	$high=array();
	$low=array();
	$close=array();
    while($row = mysqli_fetch_array($result)) 
	{
		if($row['Date']>$sdate and $row['Date'] < $edate)
		{
			$date[$i]= $row["Date"];
			$close[$i]= $row["Close"];
			$high[$i]=$row["High"];
			$d[$i]=array($high[$i],$close[$i]);
			$i++;
        }
    }

}
require_once('as-diagrams.php');
?>
<HTML>
<HEAD><TITLE>chart</TITLE>
<META http-equiv="Content-Type" Content="text/html; charset=windows-1251">
</HEAD>
<BODY>
<?
$data_title = $code; 
$i=0;
$data = array();
foreach($d as $x)
{
	$data[] = $x;
}
$legend_x = $date;
$legend_y = array('high','close');
$graph = new CAsBarDiagram;
$graph->bwidth = 10; // set one bar width, pixels
$graph->bt_total = 'Summary'; // 'totals' column title, if other than 'Totals'
$graph->showtotals = 0;  // uncomment it if You don't need 'totals' column
$graph->precision = 0;  // decimal precision
// call drawing function
$graph->DiagramBar($legend_x, $legend_y, $data, $data_title);

?>
<hr>
</BODY></HTML>
	