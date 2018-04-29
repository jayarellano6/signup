<?php

    include 'dbConnection.php';
    $conn = getDatabaseConnection("lab8");
    
    $first = $_GET['firstname'];
    $last = $_GET['lastname'];
    $email = $_GET['email'];
    $username = $_GET['username'];
    $pass = $_GET['password'];
    $zip = $_GET['zipcode'];
    
    $sql = "INSERT INTO lab8_user (userId, firstName, lastName, email, username, password, zipCode) VALUES (NULL, '$first', '$last', '$email', '$username', '$pass', '$zip');";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(":username" => $username));
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode($record);

?>