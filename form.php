<?php
session_start();
if(!$_SESSION["user"])
header('location: index.php');
global $e;
$e=$_SESSION["user"];

include("includes/db.php");
if($_GET["code"])
{
	$c=$_GET["code"];
	$con=mysqli_connect('sql308.byethost11.com','b11_18001806','eshu@123','b11_18001806_dbms');
	if (mysqli_connect_errno($con)) 
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$sql1="select * from company where  code='$c'";

	$result=mysqli_query($con,$sql1);
	if($result)
	{
		if(mysqli_num_rows($result)==0)
		{
			echo '<script language="javascript">';
			echo 'alert("code adding failed not a valid code")';  //not showing an alert box.
			echo '</script>';
		}
		else
		{
			$sql="INSERT INTO com(username,code) VALUES('$e','$c')";
			$query=mysqli_query($con,$sql);
			if($query)
			{
				echo '<script language="javascript">';
				echo 'alert("Successful")';  //not showing an alert box.
				echo '</script>';
                main($c);
			}
		}
	}
	else
	{
		echo '<script language="javascript">';
		echo 'alert("code adding failed ")';  //not showing an alert box.
		echo '</script>';
	}
}

function createURL($tickername)
{

    return "http://www.google.com/finance/historical?q=$tickername&startdate=AUG+1%2C+2017&enddate=NOV+19%2C+2017&output=csv";
}
function getCSVFile($url,$outputFile)
{
	$content=file_get_contents($url);
    $content=str_replace("Date,Open,High,Low,Close,Volume","",$content);
	$content=trim($content);
	file_put_contents($outputFile,$content);
}
function filetoDatabase($textfile,$tablename)
{
    $count=0;
	$file = fopen($textfile,"r");
	$line=fgets($file);
	while(!feof($file))
	{
        $line=fgets($file);
		$pieces=explode(",",$line);
		$date=$pieces[0];
		$mdate=date("Y-m-d",strtotime($date));
		$open=$pieces[1];
		$high=$pieces[2];
		$low=$pieces[3];
		$close=$pieces[4];
		$volume=$pieces[5];
		$amount_change=$close-$open;
		if($open==0)
        {
			continue;
		}
                $percent_change=(($amount_change/$open)*100);
		$connect=mysqli_connect('sql308.byethost11.com','b11_18001806','eshu@123')or die("error");
                mysqli_select_db($connect,"b11_18001806_dbms")or die("error");
		$sql="SELECT * FROM $tablename";
		$result=mysqli_query($connect,$sql);
		if(!$result)
		{
			$sql2= "CREATE TABLE $tablename(Date VARCHAR(10) PRIMARY KEY,Open FLOAT,High FLOAT,Low FLOAT,Close FLOAT,Volume INT(6),amount_change FLOAT,percent_change FLOAT) ";
			mysqli_query($connect,$sql2);
		}
		$sql4="SELECT * FROM $tablename where date='$date'";
		$result1=mysqli_query($connect,$sql4);
		if($result1)
		{
			if(mysqli_num_rows($result1)==0)
			{
		
				$sql3="INSERT INTO $tablename(Date,Open,High,Low,Close,Volume,amount_change,percent_change) VALUES('$mdate','$open','$high','$low','$close','$volume','$amount_change','$percent_change')";
				mysqli_query($connect,$sql3);
			}
		}
		else
		{
			echo "error processing query";
		}
		
	}
	fclose($file);
}
function main($e)
{
	
	$companyticker=trim($e);
	$fileurl=createURL($companyticker);
	$companytxtfile="txtfiles/".$companyticker.".txt";
	getCSVFile($fileurl,$companytxtfile);
	filetoDatabase($companytxtfile,$companyticker);   
}
?>
<html>
<head>
<script>
function myFunction() {
 
    var input, filter, ul, li, a, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";

        }
    }
}
function showResult(str) {
  if (str.length==0) { 
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","search.php?key="+str,true);
  xmlhttp.send();
}
</script>
<style>
* {
  box-sizing: border-box;
}

#myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 12px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myUL {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

#myUL li a {
  border: 1px solid #ddd;
  margin-top: -1px; /* Prevent double borders */
  background-color: #f6f6f6;
  padding: 12px;
  text-decoration: none;
  font-size: 18px;
  color: black;
  display: block
}

#myUL li a:hover:not(.header) {
  background-color: #eee;
}

body {
  margin: 0;
}

/* Style the header */
.header {
    background-color: #f1f1f1;
    text-align: center;
}

/* Style the top navigation bar */
.topnav {
margin: 7px;
    overflow: hidden;
    background-color: white;
height: 350px;    
}

/* Style the topnav links */
.topnav a {
    padding: 14px 16px;
float: left;
    display: block;
    color: black;
    text-align: center;
 
    text-decoration: none;
}

/* Change color on hover */
.topnav a:hover {
    background-color: #4CAF50;
    color: black;
}

/* Create three unequal columns that floats next to each other */
.column {

    float: left;
    padding: 15px;

}

/* Left and right column */
.column.side {
    width: 26%;
 background-color: #e1e8e5;
}

/* Middle column */
.column.middle {
	background-color: white;
    width: 47.5%;
margin-left: 0.20%;
margin-right: 0.20%;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

/* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
@media (max-width: 600px) {
    .column.side, .column.middle {
        width: 100%;
    }
}

/* Style the footer */
.footer {
    background-color: #f1f1f1;
    padding: 10px;
    text-align: center;
}
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

input[type=submit]:hover {
    background-color: #45a049;
}
</style>
</head>
<body bgcolor= #cfd1d3>
<div class="row " style="background-color:  #f1f1f1">
<div class="header">
<div class="header" style="float:left;">
<?php
echo " welcome  " ;
echo $e;
?>
</div>
<div class="header" style="float: right;">
<a href=logout.php>logout</a>
</div>
</div>
</div>
<div class="row">
<div class="header">
<a href="index.php"> <img src="banner.png" height=44% width=100%></a>
</div>
</div>
<div class="row">
<div class="column side" style="height: 350px; overflow: hidden;">
<div class="topnav" >
<div style="background-color:#434547; border: 2px solid white; border-radius: 1em;">
<h2 ><center><font color="white">Navigation Bar</font></center></h2>
</div>
<p><a href=two.php>click here to see stock of company side by side</a></p>
<p><a href=analysis_a.php>click here to see analysis of company by observing history</a></p>
<p><a href=account.php>click here to edit details of account</a></p><br>
</div>
</div>
<div class="column middle" style=" height: 350px;"  >
<div style="  margin: auto; width: 90%;">
<div>
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for companies click on them to add" title="Type in a name">
</div>
<div style="overflow-y: scroll; height: 250px;">
<ul id="myUL">
<?php
$key=$_GET['key'];
$array = array();
$con=mysqli_connect('sql308.byethost11.com','b11_18001806','eshu@123','b11_18001806_dbms');
if (mysqli_connect_errno($con)) 
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$query=mysqli_query($con,"select * from company ");
while($row=mysqli_fetch_assoc($query))
{
    $s="form.php?code=".$row['code'];
    ?>
	<li><a href="<?php echo $s ?>"><?php echo $row['name'] ?></a></li>
    <?php
}
?>
</ul>
</div>
</div>
</div>
<div class="column side" style=" height:350px;">
<div style=" margin: 7px;  background-color: white; ">
<div style="background-color: #434547; border: 2px solid white; border-radius: 1em;">
<center><font color="white"><h2 >Your installed companies:</h2>Select the company to see stock</font></center>
</div>
<div style="height: 250px;overflow-y: scroll;">
<?php
$con=mysqli_connect('sql308.byethost11.com','b11_18001806','eshu@123','b11_18001806_dbms');
if (mysqli_connect_errno($con)) 
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$e=$_SESSION["user"];
$query=mysqli_query($con,"select * from com where username = '$e'");
while($row=mysqli_fetch_assoc($query))
{
	?>
	<p>
	<form action="individualcompany.php" method="post">
    <input name="code" type="hidden" value=" <?php echo $row["code"] ; ?>" >
	<input type=submit value=" <?php echo htmlspecialchars($row["code"]) ; ?>" >
	</form>
	</p>
	<?php
}
?>
</div>
</div>
</div>
</div>
</body>
</html>		