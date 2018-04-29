<?php
function getDatabaseConnection($dbname) {
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = $dbname; 
        
        if(strpos($_SERVER['HTTP_HOST'], 'herokuapp') !== false) {
           $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
           $host = $url["host"];
           $dbname   = substr($url["path"], 1);
           $username = $url["user"];
           $password = $url["pass"];
        }
        
        // Create connection
        $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        return $dbConn; 
    }
?>