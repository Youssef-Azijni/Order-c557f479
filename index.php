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

if (isset($_GET['seriesOrder'])) {
    $order = $_GET['seriesOrder'];

    if ($order == 'title') {
        $seriesDATA = 'SELECT * FROM series';
    }
    if ($order == 'rating') {
        $seriesDATA = 'SELECT * FROM series ORDER BY rating';
    } else {
        $seriesDATA = 'SELECT * FROM series';
    }
}


echo "<h1>Welcome, this is your $db control panel, change whatever you like. </h1>";


$seriesQuery = $pdo->query($seriesDATA);
$series = $seriesQuery->fetchALL(PDO::FETCH_ASSOC);

echo "
<h2>Series </h2>
<table>
    <tr>
        <td> Title </td>
        <td> Title </td>
    <tr>
';

foreach ($series as $row) {
    echo "
    <tr>
        <td>$row[title]</td>
        <td>$row[rating]</td>
    <tr>";
}

echo "</table>";

$moviesDATA = 'SELECT * FROM movies';

$moviesQuery = $pdo->query($moviesDATA);
$movies = $moviesQuery->fetchAll(PDO::FETCH_ASSOC);


foreach ($movies as $row) {
    echo "
        <tr> 
            <td>$row[title]</td>
             <td>$row[duur]</td>
        </tr> ";
}

echo "</table>";

