<?php
$host = '127.0.0.1:3306';
$db = 'netland';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo($dsn);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

echo "<p><a href='index.php'>Go Back!</a></p>";

$id = $_GET['id'];
$movieData = "SELECT * FROM movies WHERE id='$id'";

$movieQuery = $pdo->query($movieData);
$films = $movieQuery->fetchAll(PDO::FETCH_ASSOC);


foreach ($movies as $row) {
    echo '<h1>' . $row['title'] . '</h1>';

    echo '<p>' . "Releasedate:" . $row['datum_van_uitkomst'] . '</p>';
    echo '<p>' . "Country of origin" . $row['land_van_uitkomst'] . '</p>';
    echo '<p>' . $row['description'] . '<p>';

    $videoID = $row["youtube_trailer_id"];
    echo("<iframe width=\"1051\" height=\"600\" src=\"https://www.youtube.com/embed/CryXRQ2WDm4\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe> ");

}

