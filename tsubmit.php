<?php
session_start();
if(!$_SESSION["user"])
header('location: index.php');
$user=$_SESSION["user"];
$t1=$_POST['select'];
$t2=$_POST['select2'];
$edate=$_POST['edate'];
$sdate=$_POST['sdate'];
if(!$t1 or !$t2 or !$edate or !$sdate)
{
echo "eneter all the input";
die();
}
if($t1==$t2)
{
echo " both ticker are same try again";
}
display($t1,$t2,$edate,$sdate);
function display($t1,$t2,$edate,$sdate)
{
	$tc1=array();
	$tc2=array();
	$d=array();
	?>
	<html>
	<head>
<style>
table {
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
	<title> <?php echo $t1."and".$t2; ?>

	</title>
	</head>
	<body>
	<center>
	<form method=post action=tchart.php target="_blank" >
	<input type="hidden" name=select value="<?php echo $t1 ; ?>" >
	<input type="hidden" name=select2 value="<?php echo $t2 ; ?>" >
	<input type="hidden" name=edate value="<?php echo $edate ; ?>" >
	<input type="hidden" name=sdate value="<?php echo $sdate ; ?>" >
	<input type="submit" value="get chart" >
	</form>
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
	?>
	<table border='1'>
	<tr>
	<th>Date</th>
	<th><?php echo $t1; ?></th>
	<th><?php echo $t2; ?></th>
	<?php
$i=0;
	while($row = mysqli_fetch_array($result))
	{
		if($row['Date']>$sdate and $row['Date'] < $edate)
		{
			$d[$i]= $row['Date']; 
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
while($d[$i]&&$tc1[$i]&&$tc2[$i])
{
          ?>
			<tr>
			<td><?php echo $d[$i] ; ?></td>
			<td><?php echo $tc1[$i]; ?></td>
            <td><?php echo $tc2[$i] ;?> </td>
			</tr>
			<?php
$i++;
}
	?>
	</table>
	</center>
	</body>
	</html>
	<?php
}
?>	
			