<?php
session_start();
require_once("functions.php");
// ตรวจสอบค่าที่ส่งมาผ่าน ajax แบบ POST ในที่นี้เราจะเช็ค 3 ค่า ว่ามีส่งมาไหม
if(isset($_POST['email']) && $_POST['email']!=""
){
    // กำหนดรูปแบบรหัสสำหรับ gg_authorized สำหรับไว้ใช้ล็อกอิน ในท่ี่นี้ใช้รูปแบบอย่างง่าย 
    // ใช้ ไอดี ต่อกับ รหัสพิเศษกำหนดเอง สามารถไปประยุกต์เข้ารหัสรูปแบบอื่นเพิ่มเติมได้
    /*
    $gg_secret_set = "mysecret";
    $gg_string_authorized = $gg_secret_set.trim($_POST['ggid']); // ต่อข้อความสำหรับเข้ารหัส
    $gg_gen_authorized = md5($gg_string_authorized);
     */
    $email = $_POST['email'];
    $sql_check="
    SELECT * FROM users WHERE email='".$email."'
    ";
    $result = $mysqli->query($sql_check);
    if($result && $result->num_rows>0){  // มีสมาชิกที่ล็อกอินด้วย google id นี้ในระบบแล้ว
        // ดึงข้อมูลมาแสดง และสร้าง session
        $row = $result->fetch_array();
        $_SESSION['userID']=$_POST['ggid'];
        $_SESSION['firstname']=$row['first_name'];
        $_SESSION['lastname']=$row['last_name'];       
        $_SESSION['photoURL']=$row['picture'];     
        $_SESSION['ses_user_last_login']=date("Y-m-d H:i:s");
        // อัพเดทเวลาล็อกอินล่าสุด
        $sql_update="
        UPDATE users SET 
        user_last_login=NOW()
        WHERE user_id='".$row['user_id']."'
        ";
        $mysqli->query($sql_update);
    }else{   // ไม่พบสมาชิกที่ใช้ google id นี้ล็อกอิน
        // สร้างผู้ใช้ใหม่
        //  สมมติให้ชื่อผู้ใช้ใหม่เป็น gg_ไอดี รหัสผ่านเป็น แรนดอม 
        $sql_insert="
        INSERT INTO users SET
        user_id='".$_POST['ggid']."',
        first_name='".$_POST['first_name']."',
        last_name='".$_POST['last_name']."',
        email='".$_POST['email']."',
        picture='".$_POST['photo']."',
        user_pass='".rand(11111111, 9999999)."',
        created=NOW(),
        user_gg_connect='1',
        user_last_login=NOW()
        ";  
        $sessData['userLoggedIn'] = TRUE;
        $result = $mysqli->query($sql_insert);
        if($result && $mysqli->affected_rows>0){
            $insert_userID = $mysqli->insert_id;
            $sql="
            SELECT * FROM users WHERE user_id='".$email."'
            AND user_gg_connect=1 
            ";
            $result = $mysqli->query($sql);
            if($result && $result->num_rows>0){  // มีสมาชิกที่ล็อกอินด้วย google id นี้ในระบบแล้ว
                // ดึงข้อมูลมาแสดง และสร้าง session
                $row = $result->fetch_array();
                $_SESSION['userID']=$_POST['ggid'];
                $_SESSION['firstname']=$row['first_name'];
                $_SESSION['lastname']=$row['last_name'];       
                $_SESSION['photoURL']=$row['picture'];
                $_SESSION['ses_user_last_login']=date("Y-m-d H:i:s");               
                // อัพเดทเวลาล็อกอินล่าสุด
                $sql_update="
                UPDATE users SET 
                user_last_login=NOW()
                WHERE id='".$row['user_id']."'
                ";
                $mysqli->query($sql_update);                         
            }
        }
    }
    $_SESSION['userLoggedIn'] =TRUE;
    header("Location:index.php");
/*echo "<pre>";
echo $gg_gen_authorized;
print_r($_POST);
echo "</pre>";*/
}
