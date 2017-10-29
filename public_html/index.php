<?php

$host = '127.0.0.1';
$user = 'root';
$pass = 'docker';

$conn = new mysqli($host, $user, $pass);

$sql = 'show databases';
$results = $conn->query($sql);

?>

<h1>Hello Docker!</h1>

<ul>
    <?php while ($row = $results->fetch_assoc()) : ?>
        <li><?= $row['Database'] ?></li>
    <?php endwhile ?>
</ul>
