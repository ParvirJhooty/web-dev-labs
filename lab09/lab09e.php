<?php
// Improved MySQL Connection
$servername = "localhost";
$username = "pjhooty";
$password = "AASaKLFM";
$dbname = "pjhooty";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Functions to retrieve data
function getRandomPhoto($conn) {
    $sql = "SELECT * FROM photos ORDER BY RAND() LIMIT 1";
    return $conn->query($sql);
}

function getTotalImages($conn) {
    $sql = "SELECT COUNT(*) AS total FROM photos";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row["total"];
}

// Retrieve data
$result_random = getRandomPhoto($conn);
$total_images = getTotalImages($conn);

// Start HTML document
?>
<!DOCTYPE html>
<html>
<head>
    <title>Random Photo Gallery</title>
    <style>
        .random-photo {
            max-width: 500px;
            text-align: center;
            margin-top: 20px;
        }
        img {
            max-width: 100%;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<h2>Random Photo</h2>
<?php
if ($result_random->num_rows > 0) {
    $row_random = $result_random->fetch_assoc();
    ?>
    <div class='random-photo'>
        <img src='<?php echo $row_random["picture_url"]; ?>' alt='Random Photo'>
        <p><strong>Subject:</strong> <?php echo $row_random["subject"]; ?><br>
           <strong>Location:</strong> <?php echo $row_random["location"]; ?></p>
    </div>
    <?php
} else {
    echo "<p>No photos found.</p>";
}

// Display total number of images
echo "<p>Total number of images: $total_images</p>";

?>
</body>
</html>
<?php
$conn->close();
?>
