<?php


$hostdb = "sql308.byethost11.com"; // MySQl host
$userdb = "b11_18001806"; // MySQL username
$passdb = "eshu@123"; // MySQL password
$namedb = "b11_18001806_dbms"; // MySQL database name

// Establish a connection to the database
$dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb);

/*Render an error message, to avoid abrupt failure, if the database connection parameters are incorrect */
if ($dbhandle->connect_error) {
exit("There was an error with your connection: ".$dbhandle->connect_error);
}
    // Form the SQL query that returns the top 10 most populous countries
    $strQuery = "SELECT * FROM NFLX ORDER BY Date";
echo $strQuery;
    // Execute the query, or else return the error message.
    $result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

    // If the query returns a valid response, prepare the JSON string
    if ($result) {


// Push the data into the array
        while($row = mysqli_fetch_array($result)) {
echo $row["Date"];
echo $row["Close"];
        
        
        }

       

        // Close the database connection
        $dbhandle->close();
    }

?>
