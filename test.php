<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Movie List</title>
  <style>
    body { font-family: Arial, sans-serif; background:#f8f8f8; margin:40px; }
    h1 { color:#333; }
    table { width:80%; border-collapse:collapse; background:#fff;
            box-shadow:0 0 10px rgba(0,0,0,0.1); }
    th, td { border:1px solid #ccc; padding:10px; text-align:left; }
    th { background:#007BFF; color:#fff; }
    tr:nth-child(even){background:#f2f2f2;}
  </style>
</head>
<body>

<h1>🎬 Movie List</h1>

<?php
// connect to database
$mysqli = new mysqli("localhost","2406376","lafas#123456789","db2406376");

// check connection
if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

// retrieve movies
$sql = "SELECT movie_name, genre, price, date_of_release FROM movies ORDER BY date_of_release DESC";
$result = $mysqli->query($sql);

if (!$result) {
    die("Error running query: " . $mysqli->error);
}

// display table
echo "<table>";
echo "<tr><th>Movie Name</th><th>Genre</th><th>Price</th><th>Date of Release</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['movie_name']) . "</td>";
    echo "<td>" . htmlspecialchars($row['genre']) . "</td>";
    echo "<td>£" . number_format($row['price'], 2) . "</td>";
    echo "<td>" . date("d/m/Y", strtotime($row['date_of_release'])) . "</td>";
    echo "</tr>";
}
echo "</table>";

$mysqli->close();
?>

</body>
</html>
