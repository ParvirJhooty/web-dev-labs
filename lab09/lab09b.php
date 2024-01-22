<?php
$servername = "localhost";
$username = "pjhooty";
$password = "AASaKLFM";
$dbname = "pjhooty";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM photos ORDER BY date_taken DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Photo Gallery</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        td img {
            max-width: 100%;
            max-height: 100px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php if (count($results) > 0): ?>
        <table>
            <tr>
                <th>Picture Number</th>
                <th>Subject</th>
                <th>Location</th>
                <th>Date Taken</th>
                <th>Picture</th>
            </tr>
            <?php foreach ($results as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['picture_number']) ?></td>
                    <td><?= htmlspecialchars($row['subject']) ?></td>
                    <td><?= htmlspecialchars($row['location']) ?></td>
                    <td><?= htmlspecialchars($row['date_taken']) ?></td>
                    <td><img src="<?= htmlspecialchars($row['picture_url']) ?>" alt="Picture"></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No records found.</p>
    <?php endif; ?>
</body>
</html>

<?php
$conn = null; // Close the connection
?>