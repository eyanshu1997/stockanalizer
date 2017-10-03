<?php
include("includes/db.php");

function createURL($tickername,$startday,$startmonth,$startyear)
{
   $currentmonth=date("n");
   switch($currentmonth)
   {
	case 1: $currentmon="jan";
	break;
	case 2: $currentmon="feb";
	break;
	case 3: $currentmon="mar";
	break;
	case 4: $currentmon="apr";
	break;
	case 5: $currentmon="may";
	break;
    case 6: $currentmon="jun";
	break;
	case 7: $currentmon="jul";
	break;
	case 8: $currentmon="aug";
    break;
	case 9: $currentmon="sep";
	break;
	case 10: $currentmon="oct";
	break;
	case 11: $currentmon="nov";
	break;
	case 12: $currentmon="dec";
	break;
	}
 switch($startmonth)
   {
    case 1: $endmon="jan";
	break;
	case 2: $endmon="feb";
	break;
	case 3: $endmon="mar";
	break;
	case 4: $endmon="apr";
	break;
	case 5: $endmon="may";
	break;
	case 6: $endmon="jun";
	break;
	case 7: $endmon="jul";
	break;
	case 8: $endmon="aug";
	break;
	case 9: $endmon="sep";
	break;
	case 10: $endmon="oct";
	break;
	case 11: $endmon="nov";
	break;
	case 12: $endmon="dec";
	break;
	}

    $currentday=date("j");
    $currentyear=date("Y");
    return "http://www.google.com/finance/historical?q=$tickername&startdate=$endmon+$startday%2C+$startyear&enddate=$currentmon+$currentday%2C+$currentyear&output=csv";
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
		$sql3="INSERT INTO $tablename(Date,Open,High,Low,Close,Volume,amount_change,percent_change) VALUES('$mdate','$open','$high','$low','$close','$volume','$amount_change','$percent_change')";
		mysqli_query($connect,$sql3);
    }
	fclose($file);
}

function main($startday,$startmonth,$startyear)
{
	$maintickerfile= fopen("tickermaster.txt","r");
	while(!feof($maintickerfile))
	{
		$companyticker=fgets($maintickerfile);
		$companyticker=trim($companyticker);
		$fileurl=createURL($companyticker,$startday,$startmonth,$startyear);
		$companytxtfile="txtfiles/".$companyticker.".txt";
		getCSVFile($fileurl,$companytxtfile);
		filetoDatabase($companytxtfile,$companyticker);
	}
}
function values()
{
	$day=$_POST['a'];
	$month=$_POST['b'];
	$year=$_POST['c'];
	$currentyear=date("Y");
	$d=array("1", "2", "2", "4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31");
	$m=array("1", "2", "2", "4","5","6","7","8","9","10","11","12");
	if(!(in_array($day, $d)&&in_array($month,$m)))
	{
		die("wrong date");
	}
	else
	{
		main($day,$month,$year);
        header('location:	show.php');
	}
}
values();
?>