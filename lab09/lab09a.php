<?php

// Database configuration
$servername = "localhost";
$username = "pjhooty";
$password = "AASaKLFM";
$dbname = "pjhooty";

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to execute a query and display a success or error message
function executeQuery($conn, $sql, $successMsg, $errorMsg) {
    if ($conn->query($sql) === TRUE) {
        echo $successMsg . "<br>";
    } else {
        echo $errorMsg . $conn->error . "<br>";
    }
}

// Drop the 'photos' table if it exists
$sqlDropTable = "DROP TABLE IF EXISTS photos";
executeQuery($conn, $sqlDropTable, "Table 'photos' dropped successfully", "Error dropping table: ");

// Create the 'photos' table
$sqlCreateTable = "CREATE TABLE IF NOT EXISTS photos (
    picture_number INT PRIMARY KEY,
    subject VARCHAR(255),
    location VARCHAR(255),
    date_taken DATE,
    picture_url VARCHAR(255)
)";
executeQuery($conn, $sqlCreateTable, "Table 'photos' created successfully", "Error creating table: ");

// Insert data into the 'photos' table
$sqlInsertData = "INSERT INTO photos (picture_number, subject, location, date_taken, picture_url)
        VALUES 
        (1, 'Porsche', 'Las Vegas', '2017-10-18', 'https://i.imgur.com/nDsPTR6.jpeg'),
        (2, 'BMW', 'New York', '2013-06-30', 'https://i.imgur.com/HoWL6o3.jpeg'),
        (3, 'Ferrari', 'Germany', '2016-08-16', 'https://i.imgur.com/cNwWn9V.jpeg'),
        (4, 'Lamborghini', 'London', '2015-06-23', 'https://i.imgur.com/rnOinzk.jpeg'),
        (5, 'Lexus', 'Tokyo', '2013-09-05', 'https://i.imgur.com/kjV4tzk.jpeg'),
        (6, 'Audi', 'Ontario', '2017-11-18', 'https://i.imgur.com/khq74h6.jpeg'),
        (7, 'Acura', 'Portland', '2015-12-01', 'https://i.imgur.com/JukyJHm.jpeg'),
        (8, 'Mercedes', 'Munich', '2014-02-28', 'https://i.imgur.com/Ak0uN6o.jpeg'),
        (9, 'Ford', 'Alaska', '2018-01-18', 'https://i.imgur.com/MDZ3F27.jpeg'),
        (10, 'Jeep', 'Florida', '2013-07-19', 'https://i.imgur.com/FSUfpEy.jpeg')
        ";

executeQuery($conn, $sqlInsertData, "Data inserted into 'photos' table successfully", "Error inserting data: ");

// Close the database connection
$conn->close();
?>