<?php

    include 'dbConnection.php';
    $conn = getDatabaseConnection("lab8");
    
    $username = $_GET['username'];
    $sql = "select * from lab8_user where username = :username";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(":username" => $username));
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode($record);

?>