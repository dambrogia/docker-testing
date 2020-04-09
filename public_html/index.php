<?php

/**
 * This file:
 *     Has not been tested
 *     Does not use prepared statements
 *     Is for Proof of Concept only!
 */

$host = 'mysql'; // Matches the name of the database container.
$user = 'root'; // For simplicity sake.
$pass = 'docker'; // Defined in docker-compose.yml.

$conn = new mysqli($host, $user, $pass);

/* check connection */
if ($conn->connect_errno) {
    printf("Connect failed: %s\n", $conn->connect_error);
    exit();
}

$sql = 'show databases';
$results = $conn->query($sql);

?>

<h1>Hello Docker!</h1>

<h4>Available Databases:</h4>

<ul>
    <?php while ($row = $results->fetch_assoc()) : ?>
        <li><?= $row['Database'] ?></li>
    <?php endwhile ?>
</ul>
