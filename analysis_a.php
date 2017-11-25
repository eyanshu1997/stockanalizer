<?php

$connect=mysqli_connect('sql308.byethost11.com','b11_18001806','eshu@123');
if(mysqli_connect_errno()) 
die("couldnt connect to server");
mysqli_select_db($connect,"b11_18001806_dbms") or die('couldnt connect to the database');

function masterloop()
{
	session_start();
	if(!$_SESSION["user"])
	header('location: index.php');
	$e=$_SESSION["user"];
$connect=mysqli_connect('sql308.byethost11.com','b11_18001806','eshu@123');
	if(mysqli_connect_errno()) 
	die("couldnt connect to server");
mysqli_select_db($connect,"b11_18001806_dbms") or die('couldnt connect to the database');
$sql="SELECT code FROM com where username='$e'";
$result = mysqli_query($connect,$sql);
if(!mysqli_num_rows($result))
{
echo " <a href="."index.php".">add company first</a>";
die();
}
	$connect=mysqli_connect('sql308.byethost11.com','b11_18001806','eshu@123');
	if(mysqli_connect_errno()) 
	die("couldnt connect to server");
	mysqli_select_db($connect,"b11_18001806_dbms") or die('couldnt connect to the database');
	$s="SELECT * FROM com ";
	$result2 = mysqli_query($connect,$s);
	while($row2 = mysqli_fetch_array($result2))
	{
	    $companyticker=$row2['code'];
		$companyticker=trim($companyticker);
		$total=0;
		$nextdaydecreases=0;
		$nextdayincreases=0;
		$nextdaynochanges=0;
		$sumofincreases=0;
		$sumofdecreases=0;
		$sql="SELECT Date,percent_change FROM $companyticker ";
		$connect=mysqli_connect('sql308.byethost11.com','b11_18001806','eshu@123');
		if(mysqli_connect_errno()) 
		die("couldnt connect to server");
		mysqli_select_db($connect,"b11_18001806_dbms") or die('couldnt connect to the database');
		$result=mysqli_query($connect,$sql);
		if($result)
		{
			$numberofrows=mysqli_num_rows($result);
			if($numberofrows>0)
			{
				while($row=mysqli_fetch_array($result,MYSQLI_NUM))
				{
					$date=$row['0'];
					$percent_change=$row['1'];
					if($percent_change>'0')
					{
						$nextdayincreases++;
						$sumofincreases+=$percent_change;
						$total++;
					}
					else
					{
						if($percent_change<'0')
						{
							$nextdaydecreases++;
							$sumofdecreases+=$percent_change;
							$total++;
						}
						else 
						{
							$nextdaynochanges++;
							$total++;
						}
					}
				}
			}
			else 
			{
				echo "unable to select $companyticker";
			}
	    }
		else 
		{
			echo "unable to select $companyticker";
		}
		$nextdayincreasepercent=($nextdayincreases/$total)*100;
		$nextdaydecreasepercent=($nextdaydecreases/$total)*100;
		if($nextdayincreases=='0')
		{
			$averageincreasepercent=0;
		}		
		else $averageincreasepercent=($sumofincreases/$nextdayincreases);
		if($nextdaydecreases=='0')
		{
			$averagedecreasepercent=0;
		}
		else $averagedecreasepercent=$sumofdecreases/$nextdaydecreases;
		insertintoresulttable($companyticker,$nextdayincreases,$nextdayincreasepercent,$averageincreasepercent,$nextdaydecreases,$nextdaydecreasepercent,$averagedecreasepercent);
	}
	header('location: showanalysis_a.php');
}
function insertintoresulttable($companyticker,$nextdayincreases,$nextdayincreasepercent,$averageincreasepercent,$nextdaydecreases,$nextdaydecreasepercent,$averagedecreasepercent)
{
	$buckybuyvalue=$nextdayincreasepercent*$averageincreasepercent;
	$buckysellvalue=$nextdaydecreasepercent*$averagedecreasepercent;
	$connect=mysqli_connect('sql308.byethost11.com','b11_18001806','eshu@123');
	if(mysqli_connect_errno()) 
	die("couldnt connect to server");
	mysqli_select_db($connect,"b11_18001806_dbms") or die('couldnt connect to the database');
    $query="SELECT * FROM ANALYSISa where ticker='$companyticker'";
    $result=mysqli_query($connect,$query);
    $numberofrows=mysqli_num_rows($result);
    if($numberofrows==1)
	{
        $sql="UPDATE ANALYSISa set ticker='$companyticker',daysincint='$nextdayincreases',pctofdaysinc='$nextdayincreasepercent',avgincpct='$averageincreasepercent',daysdec='$nextdaydecreases',pctofdaysdec='$nextdaydecreasepercent',avgdecpct='$averagedecreasepercent',buckysellvalue='$buckybuyvalue',buckybuyvalue='$buckysellvalue' WHERE ticker='$companyticker' ";
		mysqli_query($connect,$sql);		
	}
	else
	{
		$sql="INSERT INTO ANALYSISa(ticker,daysincint,pctofdaysinc,avgincpct,daysdec,pctofdaysdec,avgdecpct,buckysellvalue,buckybuyvalue) VALUES('$companyticker','$nextdayincreases','$nextdayincreasepercent','$averageincreasepercent','$nextdaydecreases','$nextdaydecreasepercent','$averagedecreasepercent','$buckybuyvalue','$buckysellvalue')";
        mysqli_query($connect,$sql);
	}
}
masterloop();
?>
			