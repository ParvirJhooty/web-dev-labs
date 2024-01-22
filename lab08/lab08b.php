<!DOCTYPE html>
<html>
<head>
    <title>Multiplication Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            border-collapse: collapse;
            margin: 0 auto; /* Center the table */
            background-color: #f0f0f0; /* Light grey background */
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #d0e0f0; /* Light blue background for headers */
        }
        td {
            background-color: #ffffff; /* White background for cells */
        }
    </style>
</head>
<body>

<?php
function isValidNumber($number) {
    return isset($number) && is_numeric($number) && $number >= 3 && $number <= 12;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];

    if (isValidNumber($num1) && isValidNumber($num2)) {
        echo "<table>";
        for ($i = 1; $i <= $num1; $i++) {
            echo "<tr>";
            for ($j = 1; $j <= $num2; $j++) {
                echo "<td>" . $i * $j . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Numbers must be between 3 and 12. Please <a href='javascript:history.back()'>go back</a> and try again.</p>";
    }
} else {
    echo "<p>No data received. Please <a href='javascript:history.back()'>go back</a> to the form.</p>";
}
?>

</body>
</html>
