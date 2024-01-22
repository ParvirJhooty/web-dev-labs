<?php

// Database configuration
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

/**
 * Execute a query and return the result
 */
function executeQuery($conn, $query) {
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->get_result();
}

// Fetch distinct locations and years
$locations_result = executeQuery($conn, "SELECT DISTINCT location FROM photos");
$years_result = executeQuery($conn, "SELECT DISTINCT YEAR(date_taken) AS year FROM photos");

?>

<html>
<head>
    <style>
        /* CSS styles */
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
    </style>
</head>
<body>

<h2>Select Location and Year</h2>
<form method='post'>
    <label for='location'>Location:</label>
    <select name='location'>
        <?php while ($row = $locations_result->fetch_assoc()): ?>
            <option value='<?= $row['location'] ?>'><?= $row['location'] ?></option>
        <?php endwhile; ?>
    </select>

    <label for='year'>Year:</label>
    <select name='year'>
        <?php while ($row = $years_result->fetch_assoc()): ?>
            <option value='<?= $row['year'] ?>'><?= $row['year'] ?></option>
        <?php endwhile; ?>
    </select>

    <input type='submit' value='Search'>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected_location = $_POST["location"];
    $selected_year = $_POST["year"];

    // Secure query using prepared statements
    $query = "SELECT * FROM photos WHERE location = ? AND YEAR(date_taken) = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $selected_location, $selected_year);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0): ?>
        <div class='photo-container'>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class='photo'>
                    <img src='<?= $row["picture_url"] ?>' alt='Photo'>
                    <p><strong>Subject:</strong> <?= $row["subject"] ?><br><strong>Location:</strong> <?= $row["location"] ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No photos found for the selected location and year.</p>
    <?php endif;
}
?>

</body>
</html>

<?php $conn->close(); ?>