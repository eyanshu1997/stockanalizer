<?php
include("includes/db.php");
session_start();
if(!$_SESSION["user"])
	header('location: index.php');
$e=$_SESSION["user"];
$code=$_POST["code"];

	
$da=date("Y-m-d");
?>
<html>
<head>
<script>
function myFunction() 
{
    var input, filter, ul, li, a, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) 
	{
        a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) 
		{
            li[i].style.display = "";
		} 
		else 
		{
			li[i].style.display = "none";
		}
	}
}
function showResult(str) 
{
  if (str.length==0) 
  { 
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  if (window.XMLHttpRequest) 
  {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } 
  else 
  {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() 
  {
    if (this.readyState==4 && this.status==200) 
	{
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
.header {
    background-color: #f1f1f1;
    text-align: center;
}

.topnav {
	margin: 7px;
    overflow: hidden;
    background-color: white;
	height: 350px;    
}
.topnav a {
    padding: 14px 16px;
	float: left;
    display: block;
    color: black;
    text-align: center;
 
    text-decoration: none;
}
.topnav a:hover {
    background-color: #4CAF50;
    color: black;
}
.column {

    float: left;
    padding: 15px;

}

.column.side {
    width: 26%;
 background-color: #e1e8e5;
}
.column.middle {
	background-color: white;
    width: 47.5%;
	margin-left: 0.20%;
	margin-right: 0.20%;
}
.row:after {
    content: "";
    display: table;
    clear: both;
}
@media (max-width: 600px) {
    .column.side, .column.middle {
        width: 100%;
    }
}
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
<title><?php echo htmlspecialchars($e) ?></title>
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
<div style="overflow-y: scroll; height: 250px;">
<form method=post action="disone.php" >
Select the attributes of stock you want to see:<br>
<input type="checkbox" checked="checked" name="Open" value="Yes" />Open<br>
<input type="checkbox" checked="checked" name="High" value="Yes" />High<br>
<input type="checkbox" checked="checked" name="Low" value="Yes" />Low<br>
<input type="checkbox" checked="checked" name="Close" value="Yes" />Close<br>
<input type="checkbox" checked="checked" name="Volume" value="Yes" />Volume<br>
<input type="checkbox" checked="checked" name="amount_change" value="Yes" />amount_change<br>
<input type="checkbox" checked="checked" name="percent_change" value="Yes" />percent_change<br>
input start date: <input type=date  name=sdate max="<?php echo $d ; ?>"><br>
input end date:
<input type=date name=edate  min="
<?php
$con=mysqli_connect('sql308.byethost11.com','b11_18001806','eshu@123','b11_18001806_dbms');
if (mysqli_connect_errno($con)) 
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$s="select Date from $e order by date ASC limit 1";
$query=mysqli_query($con,$s);
if($query)
{
	while($row=mysqli_fetch_assoc($query))
		{
			echo $row["Date"];
		}
}
else
{
	echo "error";
}
?>
">
<input type=hidden name=code value="<?php echo $code ?>" >
<input type="submit" name="Sub" value="Submit" />
</form>

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
	<input type=submit name="sub" value=" <?php echo htmlspecialchars($row["code"]) ; ?>" >
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