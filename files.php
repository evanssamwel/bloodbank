<?php  
// Database connection
$connect = mysqli_connect("localhost", "root", "", "blood_bank");
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Correct SQL query
$sql = "
    SELECT 
        camps.hospital, 
        camps.address, 
        camps.city, 
        hospital.contact, 
        hospital.date, 
        hospital.time 
    FROM camps 
    INNER JOIN hospital 
    ON camps.city = hospital.city
";

$result = mysqli_query($connect, $sql);

// Handle query failure
if (!$result) {
    die("Error executing query: " . mysqli_error($connect));
}
?>  

<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Fetch Data from Two Tables</title>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
</head>  
<body>  
    <div class="container" style="width:600px;">  
        <h3 align="center">Fetch Data from Two Tables Using PHP and MySQL</h3>  
        <div class="table-responsive">  
            <table class="table table-striped">  
                <thead>
                    <tr>  
                        <th>Hospital</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Contact</th>
                        <th>Date</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                <?php  
                // Check if rows are returned
                if (mysqli_num_rows($result) > 0) {  
                    while ($row = mysqli_fetch_assoc($result)) {  
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["hospital"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["address"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["city"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["contact"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["date"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["time"]) . "</td>";
                        echo "</tr>";
                    }  
                } else {  
                    echo "<tr><td colspan='6' align='center'>No Data Found</td></tr>";
                }
                ?>
                </tbody>
            </table>  
        </div>  
    </div>  
</body>  
</html>  
