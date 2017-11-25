<?php
    $key=$_GET['key'];
    $array = array();
    $con=mysqli_connect('sql308.byethost11.com','b11_18001806','eshu@123','b11_18001806_dbms');
    if (mysqli_connect_errno($con)) 
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    

    $query=mysqli_query($con,"select * from company where name LIKE '%{$key}%'");
?>
<html>
<head>
</head>
<body>
<?php
    while($row=mysqli_fetch_assoc($query))
    {
           echo "code for  ";
           echo $row["name"];
           echo " is:  ";
           echo $row["code"];
           echo "<br>";
    }
   
?>
</body>
</html>

							