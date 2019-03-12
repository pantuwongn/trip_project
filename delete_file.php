<?php
    session_start();
    include("db_connect.php");
    $filename = 'upload/'.$_POST['filename'];
    unlink($filename);
    $trip_id = $_SESSION['trip_id'];
    $sql = "DELETE FROM trip_photo where trip_photo_name='".$_POST['filename']."'";
    $conn->query($sql);
    echo $filename;
?>