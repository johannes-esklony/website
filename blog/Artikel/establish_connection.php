<?php
    $servername = "toasterlab.crabdance.com:3306";
    $username = "remoteaccess";
    $password = "remote";

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    //echo "Connected successfully";
    $db_use = "use newsweit;";
    $conn->query($db_use);
?>