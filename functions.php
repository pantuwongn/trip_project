<?php  
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if($_SESSION['userLoggedIn'] && $_SESSION['userLoggedIn']==TRUE) {

} else {
    header("Location:login.php");
}

$mysqli = new mysqli("localhost", "root","","halalwayz");  
/* check connection */ 
if ($mysqli->connect_errno) {  
    printf("Connect failed: %s\n", $mysqli->connect_error);  
    exit();  
}  
if(!$mysqli->set_charset("utf8")) {  
    printf("Error loading character set utf8: %s\n", $mysqli->error);  
    exit();  
}

?>
