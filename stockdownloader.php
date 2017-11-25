<?php
include("includes/db.php");

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
		$sql3="INSERT INTO $tablename(Date,Open,High,Low,Close,Volume,amount_change,percent_change) VALUES('$mdate','$open','$high','$low','$close','$volume','$amount_change','$percent_change')";
		mysqli_query($connect,$sql3);
    }
	fclose($file);
}

function main()
{
	$maintickerfile= fopen("tickermaster.txt","r");
	while(!feof($maintickerfile))
	{
		$companyticker=fgets($maintickerfile);
		$companyticker=trim($companyticker);
		$fileurl=createURL($companyticker);
echo $fileurl;
		$companytxtfile="txtfiles/".$companyticker.".txt";
		getCSVFile($fileurl,$companytxtfile);
		filetoDatabase($companytxtfile,$companyticker);
	}
die();
header('location:	show.php');
}
main();
?>