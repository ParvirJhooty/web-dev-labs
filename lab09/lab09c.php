<?php

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

// SQL query
$sql = "SELECT * FROM photos WHERE location = 'Ontario'";
$result = $conn->query($sql);

// HTML Header
echo "<html><head>";
echo "<style>
    .photo-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 20px;
    }
    .photo {
        max-width: 300px;
        text-align: center;
    }
    img {
        max-width: 100%;
        border: 1px solid #ddd;
        border-radius: 8px;
    }
</style>";
echo "</head><body>";

// Main Content
echo "<h2>Photos Taken in Ontario</h2>";

if ($result->num_rows > 0) {
    echo "<div class='photo-container'>";
    
    while($row = $result->fetch_assoc()) {
        echo "<div class='photo'>";
        echo "<img src='" . htmlspecialchars($row["picture_url"]) . "' alt='Photo'>";
        echo "<p><strong>Subject:</strong> " . htmlspecialchars($row["subject"]) . "<br><strong>Location:</strong> " . htmlspecialchars($row["location"]) . "</p>";
        echo "</div>";
    }

    echo "</div>";
} else {
    echo "<p>No photos taken in Ontario.</p>";
}

echo "</body></html>";

// Close connection
$conn->close();

?>
