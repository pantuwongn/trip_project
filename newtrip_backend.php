<?php
    session_start();
    require_once("functions.php");
    include("db_connect.php");

    if (isset($_POST['tab']) && $_POST['tab']=='basic')
    {
        $users_user_id = $_POST['users_user_id'];
        $vehicle_id = $_POST['vehicle_id'];
        $trip_type_id = $_POST['trip_type_id'];
        $trip_name = addslashes($_POST['trip_name']);
        $trip_sum = addslashes($_POST['trip_sum']);
        $trip_dest = addslashes($_POST['trip_dest']);
        $trip_activity = addslashes($_POST['trip_activity']);
        $trip_cover = $_POST['trip_cover'];

        if($_SESSION['trip_id']===0)
        {
            $sql = "INSERT INTO trips (trip_type_id, vehicle_id, users_user_id, trip_name, trip_sum, trip_dest, trip_activity, trip_cover ) VALUES ('".$trip_type_id."','".$vehicle_id."','".$users_user_id."','".$trip_name."','".$trip_sum."','".$trip_dest."','".$trip_activity."','".$trip_cover."')";
        
        }else{
            $trip_id = $_SESSION['trip_id'];

            $sql = "UPDATE trips SET trip_type_id='".$trip_type_id."', vehicle_id='".$vehicle_id."', users_user_id='".$users_user_id."', trip_name='".$trip_name."',trip_sum='".$trip_sum."',trip_dest='".$trip_dest."',trip_activity='".$trip_activity."', trip_cover='".$trip_cover."' WHERE trip_id = '".$trip_id."'";

        }
    
        if ($conn->query($sql) === TRUE) 
        {
            if($_SESSION['trip_id']===0)
            {
                $_SESSION['trip_id'] = $conn->insert_id;
            }
            echo "Success";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }else if (isset($_POST['tab']) && $_POST['tab']=='overview'){

        $fileList = json_decode($_POST['fileList']);
        
        if($_SESSION['trip_id']===0)
        {
            $sql = "INSERT INTO trips () VALUES ()";
            $conn->query($sql);
            $_SESSION['trip_id'] = $conn->insert_id;
            $trip_id = $_SESSION['trip_id'];

        }else{
            $trip_id = $_SESSION['trip_id'];
            $sql = "DELETE FROM trip_photo where trip_id='".$trip_id."'";
            $conn->query($sql);
        }
       
        $succues = TRUE;
        for($i = 0; $i < sizeof($fileList); $i++)
        {
            $sql = "INSERT INTO trip_photo (trip_id,trip_photo_name) VALUES ('".$trip_id."','".$fileList[$i]."')";
            if (!$conn->query($sql) === TRUE) 
                $succues = FALSE;

        }

        if($succues){
            echo "Success";
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }else if (isset($_POST['tab']) && $_POST['tab']=='detail'){
        $detail_data = json_decode($_POST['trip_detail_data'],true);
        $trip_meeting_addr = $_POST['meeting_addr'];
        $trip_meeting_lat = $_POST['meeting_lat'];
        $trip_meeting_lng = $_POST['meeting_lng'];
        $trip_num_day = $_POST['num_day'];

        if($_SESSION['trip_id']===0)
        {
            $sql = "INSERT INTO trips ( trip_meeting_addr, trip_meeting_lat, trip_meeting_lng, trip_num_day ) VALUES ('".$trip_meeting_addr."','".$trip_meeting_lat."','".$trip_meeting_lng."','".$trip_num_day."')";
            $conn->query($sql);
            $_SESSION['trip_id'] = $conn->insert_id;
            $trip_id = $_SESSION['trip_id'];
        
        }else{
            $trip_id = $_SESSION['trip_id'];

            $sql = "UPDATE trips SET trip_meeting_addr='".$trip_meeting_addr."', trip_meeting_lat='".$trip_meeting_lat."', trip_meeting_lng='".$trip_meeting_lng."', trip_num_day='".$trip_num_day."'  WHERE trip_id = '".$trip_id."'";
            $conn->query($sql);

        }

        $succues = TRUE;
        $sql = "DELETE FROM trip_detail where trip_id='".$trip_id."'";
        $conn->query($sql);
        for($d=1;$d<=$trip_num_day;$d++){
            $day_data = $detail_data[$d];
            $num_p = sizeof(array_keys($day_data));
            for($p=1;$p<=$num_p;$p++){
                $start = $day_data[$p]["start"];
                $start_ap = substr($start, -2);
                $end = $day_data[$p]["end"];
                $end_ap = substr($end,-2);
                $desc = addslashes($day_data[$p]["desc"]);
                $sql = "INSERT INTO trip_detail ( trip_id, trip_day, trip_detail_start, trip_detail_end, trip_detail_start_ap, trip_detail_end_ap, trip_detail_description ) VALUES ('".$trip_id."','".$d."','".$start."','".$end."','".$start_ap."','".$end_ap."','".$desc."')";
                if (!$conn->query($sql) === TRUE) {
                    $succues = FALSE;
                }

            }
        }

        if($succues){
            echo $start;
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }


    }
    $conn->close();
?>