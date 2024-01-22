<?php
$counter = 1;
$cookieName = "visitCounter";

if (isset($_COOKIE[$cookieName])) {
    $counter = intval($_COOKIE[$cookieName]) + 1;
}
setcookie($cookieName, $counter, time() + 86400 * 30); // Cookie expires after 30 days
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lab 08</title>
    <style>
        .time-based-bg {
            width: 100%;
            height: 100vh; /* Full height of the viewport */
            background-size: cover; /* Cover the entire division */
            display: flex;
            justify-content: center;
            align-items: center;
            color: white; /* Default text color */
            font-size: 10em;
        }

        .hit-counter {
            position: fixed;
            bottom: 10px;
            right: 10px;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black background */
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.9em;
        }
        
    </style>
</head>
<body>

<?php
    $hour = date("H"); // 24-hour format of an hour

    if ($hour < 12) {
        $greeting = "Good morning";
        $bgImage = "morning.jpg"; // replace with your morning image path
    } elseif ($hour < 18) {
        $greeting = "Good afternoon";
        $bgImage = "afternoon.jpg"; // replace with your afternoon image path
    } elseif ($hour < 21) {
        $greeting = "Good evening";
        $bgImage = "evening.jpg"; // replace with your evening image path
    } else {
        $greeting = "Good night";
        $bgImage = "night.jpg"; // replace with your night image path
    }
?>

<h1>Problem 1</h1>

<div class="time-based-bg" style="background-image: url('<?php echo $bgImage; ?>');">
    <?php echo $greeting; ?>
</div>

<br>

<h1>Problem 2</h1>

<form action="lab08b.php" method="post" target="_blank">
    <label for="num1">Enter First Number (3 to 12):</label>
    <input type="number" id="num1" name="num1" min="3" max="12" required>
    <br><br>
    <label for="num2">Enter Second Number (3 to 12):</label>
    <input type="number" id="num2" name="num2" min="3" max="12" required>
    <br><br>
    <input type="submit" value="Generate Multiplication Table">
</form>

<div class="hit-counter">
    Number of visits: <?php echo $counter; ?>
</div>



</body>
</html>


