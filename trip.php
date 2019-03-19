<?php
    session_start();
    require_once("config.php");
    require_once("functions.php");
    include('include/user.php');
    $user = new User();
    include("db_connect.php");

    if (!isset($_GET['trip_id'])){
      exit();
    }
    $_SESSION['trip_id'] = $_GET['trip_id'];
    $sql = "SELECT * from trips WHERE trip_id='".$_SESSION['trip_id']."'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    $trip_type_id = $data['trip_type_id'];
    $vehicle_id = $data['vehicle_id'];
    $users_user_id = $data['users_user_id'];
    $trip_name = $data['trip_name'];
    $trip_dest = $data['trip_dest'];
    $trip_sum = $data['trip_sum'];
    $trip_activity = $data['trip_activity'];
    $trip_cover = $data['trip_cover'];
    $trip_meeting_addr = $data['trip_meeting_addr'];
    $trip_meeting_lat = $data['trip_meeting_lat'];
    $trip_meeting_lng = $data['trip_meeting_lng'];
    $trip_condition_casual = $data['trip_condition_casual'];
    $trip_condition_physical = $data['trip_condition_physical'];
    $trip_condition_vegan = $data['trip_condition_vegan'];
    $trip_condition_children = $data['trip_condition_children'];
    $trip_condition_flexible = $data['trip_condition_flexible'];
    $trip_condition_seasonal  = $data['trip_condition_seasonal'];

    $sql = "SELECT * from trip_photo WHERE trip_id='".$_SESSION['trip_id']."'";
    $traveTripsQuery = mysqli_query($conn,$sql);
    $result = $conn->query($sql);
    $photo_arr = array();
    while($row = $result->fetch_assoc()) {
      array_push($photo_arr,$row['trip_photo_name']);
    }

    $sql = "SELECT * from trip_detail WHERE trip_id='".$_SESSION['trip_id']."'";
    $result = $conn->query($sql);
    $trip_detail = array();
    while($row=$result->fetch_assoc()){
      $trip_day = $row['trip_day'];
      $trip_detail_start = $row['trip_detail_start'];
      $trip_detail_start_ap = $row['trip_detail_start_ap'];
      $trip_detail_end = $row['trip_detail_end'];
      $trip_detail_end_ap = $row['trip_detail_end_ap'];
      $trip_detail_description = $row['trip_detail_description'];
      if( !array_key_exists($trip_day,$trip_detail) ){
          $trip_detail[$trip_day] = array();
      }
      $detail = array('trip_detail_start'=>$trip_detail_start, 'trip_detail_start_ap'=>$trip_detail_start_ap, 'trip_detail_end'=>$trip_detail_end, 'trip_detail_end_ap'=>$trip_detail_end_ap, 'trip_detail_description'=>$trip_detail_description);
      array_push($trip_detail[$trip_day], $detail);
    }
    $numday = sizeof(array_keys($trip_detail));

    $sql = "SELECT * from trip_price WHERE trip_id='".$_SESSION['trip_id']."'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    $price_food = $data['price_food'];
    $price_extra = $data['price_extra'];
    $price_max_pass = $data['price_max_pass'];
    $price_type = $data['price_type'];
    $price_unit1 = $data['price_unit1'];
    $price_total1 = $data['price_total1'];
    $price_unit2 = $data['price_unit2'];
    $price_total2 = $data['price_total2'];
    $price_unit3 = $data['price_unit3'];
    $price_total3 = $data['price_total3'];
    $price_unit4 = $data['price_unit4'];
    $price_total4 = $data['price_total4'];
    $price_unit5 = $data['price_unit5'];
    $price_total5 = $data['price_total5'];
    $price_unit6 = $data['price_unit6'];
    $price_total6 = $data['price_total6'];
    $price_unit7 = $data['price_unit7'];
    $price_total7 = $data['price_total7'];
    $price_unit8 = $data['price_unit8'];
    $price_total8 = $data['price_total8'];
    $price_children_allow = $data['price_children_allow'];
    $price_children = $data['price_children'];

    $sql = "SELECT * from trip_date WHERE trip_id='".$_SESSION['trip_id']."'";
    $result = $conn->query($sql);
    $date_array = array();
    while($row=$result->fetch_assoc()){
      $d = $row['trip_date'];
      $data = explode('-',$d);
      $d1 = $data[1]."/".$data[2]."/".$data[0];
      array_push($date_array,$d1);
    }
  
    $sql="SELECT * FROM users WHERE user_id = '".$users_user_id."' LIMIT 1";
    $result = $mysqli->query($sql); // ทำการ query คำสั่ง sql 
    $data = $result->fetch_assoc();
    $picture = $data['picture'];
    $firstname = $data['first_name'];
    $lastname = $data['last_name'];

    $conn->close();
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Halalwayz
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!-- Extra details for Live View on GitHub Pages -->

  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="./assets/css/material-kit.min.css?v=2.0.5" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="./assets/demo/demo.css" rel="stylesheet" />
  <link href="./assets/demo/vertical-nav.css" rel="stylesheet" />
  <link href="./assets/css/radiobuttons.css" rel="stylesheet" />
  <link href="https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/css/lightgallery.css" rel="stylesheet">
  <link rel="stylesheet" href="css/jquery-ui.multidatespicker.css">
  <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
        <style>
            body{
                background-color: #152836
            }
            .demo-gallery > ul {
                margin-bottom: 0;
            }
            .demo-gallery > ul > li {
                float: left;
                margin-bottom: 15px;
                margin-right: 20px;
                width: 200px;
            }
            .demo-gallery > ul > li a {
                border: 3px solid #FFF;
                border-radius: 3px;
                display: block;
                overflow: hidden;
                position: relative;
                float: left;
            }
            .demo-gallery > ul > li a > img {
                -webkit-transition: -webkit-transform 0.15s ease 0s;
                -moz-transition: -moz-transform 0.15s ease 0s;
                -o-transition: -o-transform 0.15s ease 0s;
                transition: transform 0.15s ease 0s;
                -webkit-transform: scale3d(1, 1, 1);
                transform: scale3d(1, 1, 1);
                height: 100%;
                width: 100%;
            }
            .demo-gallery > ul > li a:hover > img {
                -webkit-transform: scale3d(1.1, 1.1, 1.1);
                transform: scale3d(1.1, 1.1, 1.1);
            }
            .demo-gallery > ul > li a:hover .demo-gallery-poster > img {
                opacity: 1;
            }
            .demo-gallery > ul > li a .demo-gallery-poster {
                background-color: rgba(0, 0, 0, 0.1);
                bottom: 0;
                left: 0;
                position: absolute;
                right: 0;
                top: 0;
                -webkit-transition: background-color 0.15s ease 0s;
                -o-transition: background-color 0.15s ease 0s;
                transition: background-color 0.15s ease 0s;
            }
            .demo-gallery > ul > li a .demo-gallery-poster > img {
                left: 50%;
                margin-left: -10px;
                margin-top: -10px;
                opacity: 0;
                position: absolute;
                top: 50%;
                -webkit-transition: opacity 0.3s ease 0s;
                -o-transition: opacity 0.3s ease 0s;
                transition: opacity 0.3s ease 0s;
            }
            .demo-gallery > ul > li a:hover .demo-gallery-poster {
                background-color: rgba(0, 0, 0, 0.5);
            }
            .demo-gallery .justified-gallery > a > img {
                -webkit-transition: -webkit-transform 0.15s ease 0s;
                -moz-transition: -moz-transform 0.15s ease 0s;
                -o-transition: -o-transform 0.15s ease 0s;
                transition: transform 0.15s ease 0s;
                -webkit-transform: scale3d(1, 1, 1);
                transform: scale3d(1, 1, 1);
                height: 100%;
                width: 100%;
            }
            .demo-gallery .justified-gallery > a:hover > img {
                -webkit-transform: scale3d(1.1, 1.1, 1.1);
                transform: scale3d(1.1, 1.1, 1.1);
            }
            .demo-gallery .justified-gallery > a:hover .demo-gallery-poster > img {
                opacity: 1;
            }
            .demo-gallery .justified-gallery > a .demo-gallery-poster {
                background-color: rgba(0, 0, 0, 0.1);
                bottom: 0;
                left: 0;
                position: absolute;
                right: 0;
                top: 0;
                -webkit-transition: background-color 0.15s ease 0s;
                -o-transition: background-color 0.15s ease 0s;
                transition: background-color 0.15s ease 0s;
            }
            .demo-gallery .justified-gallery > a .demo-gallery-poster > img {
                left: 50%;
                margin-left: -10px;
                margin-top: -10px;
                opacity: 0;
                position: absolute;
                top: 50%;
                -webkit-transition: opacity 0.3s ease 0s;
                -o-transition: opacity 0.3s ease 0s;
                transition: opacity 0.3s ease 0s;
            }
            .demo-gallery .justified-gallery > a:hover .demo-gallery-poster {
                background-color: rgba(0, 0, 0, 0.5);
            }
            .demo-gallery .video .demo-gallery-poster img {
                height: 48px;
                margin-left: -24px;
                margin-top: -24px;
                opacity: 0.8;
                width: 48px;
            }
            .demo-gallery.dark > ul > li a {
                border: 3px solid #04070a;
            }
            .home .demo-gallery {
                padding-bottom: 80px;
            }
        </style>

  <style>
  #map {
  height:400px; 
  margin:0px;
  border: 1px solid black;
  }
  input[name="smart_casual"]  {
      display:none;
    }
 
    input[name="smart_casual"] + label
    {
      background: url("con-icon/01Gray.fw.png") no-repeat;
      background-size: 100%;
      height: 72px;
      width: 72px;
      display:inline-block;
      padding: 0 0 0 0 px;
    }
    input[name="smart_casual"]:checked + label
    {
      background: url("con-icon/01.fw.png") no-repeat;
      background-size: 100%;
      height: 72px;
      width: 72px;
      display:inline-block;
      padding: 0 0 0 0px;
    }
    
    input[name="physical_strength"]  {
      display:none;
    }
 
    input[name="physical_strength"] + label
    {
      background: url("con-icon/02Gray.fw.png") no-repeat;
      background-size: 100%;
      height: 72px;
      width: 72px;
      display:inline-block;
      padding: 0 0 0 0px;
    }
    input[name="physical_strength"]:checked + label
    {
      background: url("con-icon/02.fw.png") no-repeat;
      background-size: 100%;
      height: 72px;
      width: 72px;
      display:inline-block;
      padding: 0 0 0 0px;
    }

    input[name="vegan"]  {
      display:none;
    }
 
    input[name="vegan"] + label
    {
      background: url("con-icon/03Gray.fw.png") no-repeat;
      background-size: 100%;
      height: 72px;
      width: 72px;
      display:inline-block;
      padding: 0 0 0 0px;
    }
    input[name="vegan"]:checked + label
    {
      background: url("con-icon/03.fw.png") no-repeat;
      background-size: 100%;
      height: 72px;
      width: 72px;
      display:inline-block;
      padding: 0 0 0 0px;
    }

    input[name="children"]  {
      display:none;
    }
 
    input[name="children"] + label
    {
      background: url("con-icon/04Gray.fw.png") no-repeat;
      background-size: 100%;
      height: 72px;
      width: 72px;
      display:inline-block;
      padding: 0 0 0 0px;
    }
    input[name="children"]:checked + label
    {
      background: url("con-icon/04.fw.png") no-repeat;
      background-size: 100%;
      height: 72px;
      width: 72px;
      display:inline-block;
      padding: 0 0 0 0px;
    }

    input[name="flexible"]  {
      display:none;
    }
 
    input[name="flexible"] + label
    {
      background: url("con-icon/05Gray.fw.png") no-repeat;
      background-size: 100%;
      height: 72px;
      width: 72px;
      display:inline-block;
      padding: 0 0 0 0px;
    }
    input[name="flexible"]:checked + label
    {
      background: url("con-icon/05.fw.png") no-repeat;
      background-size: 100%;
      height: 72px;
      width: 72px;
      display:inline-block;
      padding: 0 0 0 0px;
    }

    input[name="seasonal"]  {
      display:none;
    }
 
    input[name="seasonal"] + label
    {
      background: url("con-icon/06Gray.fw.png") no-repeat;
      background-size: 100%;
      height: 72px;
      width: 72px;
      display:inline-block;
      padding: 0 0 0 0px;
    }
    input[name="seasonal"]:checked + label
    {
      background: url("con-icon/06.fw.png") no-repeat;
      background-size: 100%;
      height: 72px;
      width: 72px;
      display:inline-block;
      padding: 0 0 0 0px;
    }
}
  </style>
</head>

<body class="profile-page sidebar-collapse">
  <?php include('header.php') ?>
  <div class="page-header header-filter header-small" data-parallax="true"
    <?php
      if(strlen($trip_cover)>0)
        echo "style=\"background-image: url('upload/".$trip_cover."');\"";
      else
        echo "style=\"background-image: url('assets/img/bg9.jpg');\"";
    ?> >
    <div class="container">
      <div class="row">
        <div class="col-md-8 ml-auto mr-auto text-center">
          <h1 class="title"><?php echo $trip_name; ?></h1>
          <h4><?php echo $trip_dest; ?></h4>
        </div>
      </div>
    </div>
  </div>
  <div class="main main-raised">
  <div class="profile-content">
      <div class="container">
        <div class="row">
          <div class="col-md-6 ml-auto mr-auto">
            <div class="profile">
              <div class="avatar">
                <img src="<?php echo $picture; ?>" alt="Circle Image" class="img-raised rounded-circle img-fluid">
              </div>
              <div class="name">
                <h3 class="title"><?php echo $firstname." ".$lastname ?></h3>
                <h6>Level 3</h6>
                <a href="#pablo" class="btn btn-just-icon btn-link btn-dribbble"><i class="fa fa-dribbble"></i></a>
                <a href="#pablo" class="btn btn-just-icon btn-link btn-twitter"><i class="fa fa-twitter"></i></a>
                <a href="#pablo" class="btn btn-just-icon btn-link btn-pinterest"><i class="fa fa-pinterest"></i></a>
              </div>
            </div>
          </div>
        </div>
              <div class="card card-plain">
                <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <div class="row">
                      <div class="col-sm-12 col-md-12">
                            <span class="input-group-text">
                               <h3><b><?php echo $trip_name; ?></b></h3>
                            </span>
                      </div>
                    </div>
                    <div class="row">
                      <?php
                        if($vehicle_id==1)
                          echo "<div class=\"col-sm-4 col-md-4\"><div class=\"cc-selector\"><input [(ngModel)]=\"vehicle\" class=\"form-check-input\" checked=\"checked\" id=\"walk\" type=\"radio\" name=\"vehicle\" value=\"walk\" /><label class=\"drinkcard-cc walk\" for=\"walk\"></label></div></div>"; 
                        else if($vehicle_id==2)
                          echo "<div class=\"col-sm-4 col-md-4\"><div class=\"cc-selector\"><input [(ngModel)]=\"vehicle\" class=\"form-check-input\" checked=\"checked\" id=\"walk\" type=\"radio\" name=\"vehicle\" value=\"car\" /><label class=\"drinkcard-cc car\" for=\"car\"></label></div></div>"; 
                        else if($vehicle_id==3)
                          echo "<div class=\"col-sm-4 col-md-4\"><div class=\"cc-selector\"><input [(ngModel)]=\"vehicle\" class=\"form-check-input\" checked=\"checked\" id=\"van\" type=\"radio\" name=\"vehicle\" value=\"van\" /><label class=\"drinkcard-cc van\" for=\"van\"></label></div></div>"; 
                        else if($vehicle_id==4)
                          echo "<div class=\"col-sm-4 col-md-4\"><div class=\"cc-selector\"><input [(ngModel)]=\"vehicle\" class=\"form-check-input\" checked=\"checked\" id=\"motorbike\" type=\"radio\" name=\"vehicle\" value=\"motorbike\" /><label class=\"drinkcard-cc motorbike\" for=\"motorbike\"></label></div></div>"; 
                        else if($vehicle_id==5)
                          echo "<div class=\"col-sm-4 col-md-4\"><div class=\"cc-selector\"><input [(ngModel)]=\"vehicle\" class=\"form-check-input\" checked=\"checked\" id=\"bike\" type=\"radio\" name=\"vehicle\" value=\"bike\" /><label class=\"drinkcard-cc bike\" for=\"bike\"></label></div></div>"; 
                        else if($vehicle_id==6)
                          echo "<div class=\"col-sm-4 col-md-4\"><div class=\"cc-selector\"><input [(ngModel)]=\"vehicle\" class=\"form-check-input\" checked=\"checked\" id=\"boat\" type=\"radio\" name=\"vehicle\" value=\"boat\" /><label class=\"drinkcard-cc boat\" for=\"boat\"></label></div></div>"; 
                        else if($vehicle_id==7)
                          echo "<div class=\"col-sm-4 col-md-4\"><div class=\"cc-selector\"><input [(ngModel)]=\"vehicle\" class=\"form-check-input\" checked=\"checked\" id=\"public\" type=\"radio\" name=\"vehicle\" value=\"public\" /><label class=\"drinkcard-cc public\" for=\"public\"></label></div></div>"; 
                      ?>
                      <?php
                        if($numday > 0 ){
                          echo "<div class=\"col-sm-4 col-md-4\" align=\"center\"><div class=\"row\"><span class=\"input-group-text\"><i class=\"material-icons\">watch_later</i> </span></div><div class=\"row\"><p>".$numday." Day(s)</p></div></div>";
                        }

                        if($price_max_pass > 0 ){
                          echo "<div class=\"col-sm-4 col-md-4\" align=\"center\"><div class=\"row\"><span class=\"input-group-text\"><i class=\"material-icons\">people</i> </span></div><div class=\"row\"><p>1 - ".$price_max_pass." Traveller(s)</p></div></div>";
                        }

                        if( ($vehicle_id>=1&&$vehicle_id<=7) || $numday > 0 || $price_max_pass > 0) 
                          echo "<div class=\"col-md-12 col-sm=12\"><hr></div>";
                      ?>
                    </div>
                    <div class="row">
                      <div class="col-sm-12 col-md-12">
                            <span class="input-group-text">
                               <h4><b>Trip Summarize</b></h4>
                            </span>
                            <p><?php echo $trip_sum; ?></p><br/><hr>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12 col-md-12">
                            <span class="input-group-text">
                               <h4><b>Trip Detail</b></h4>
                            </span>
                            <div class="container">
                              <div class="row">
                              <span class="input-group-text">
                               <h6><b>Meeting Point (On the first date)</b></h6>
                              </span>
                                <div id="map"></div> 
                                <?php 
                                  if (strlen($trip_meeting_addr)>0){
                                    echo "<br><u>Meeting at :</u><p><i>".$trip_meeting_addr."</i></p>";
                                  }
                                ?>
                              </div>
                              <div class="row">
                              <span class="input-group-text">
                               <h6><b>Detail</b></h6>
                              </span>
                              <?php
                                if($numday==0){
                                  echo "<p> No detail. </p>";
                                }else{
                                  for($d=1;$d<=$numday;$d++){
                                    if($d>1){
                                      echo "<br>";
                                    }
                                    echo "<div class=\"col-md-12 col-sm-12\" style=\"margin:5px\">";
                                    echo "<p><u>Detail for Day ".$d."</u></p>";

                                    echo "<div class=\"table-responsive\">";
                                    echo "<table class=\"table\">";
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<th class=\"text-center\">Start</th>";
                                    echo "<th class=\"text-center\">End</th>";
                                    echo "<th class=\"text-center\">Description</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    $details = $trip_detail[$d];
                                    for($p=1;$p<=sizeof($details);$p++){
                                      $start_time = $details[$p-1]['trip_detail_start']." ".$details[$p-1]['trip_detail_start_ap'];
                                      $end_time = $details[$p-1]['trip_detail_end']." ".$details[$p-1]['trip_detail_end_ap']; 
                                      echo "<tr>";
                                      echo "<td class=\"text-center\">".$start_time."</td>";
                                      echo "<td class=\"text-center\">".$end_time."</td>";
                                      echo "<td class=\"text-center\">".$details[$p-1]['trip_detail_description']."</td>";
                                      echo "</tr>";
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
                                    echo "</div>";
                                    echo "</div>";
 
                                  }
                                }
                                echo "<div class=\"col-sm-12 col-md-12\"><hr></div>";
                              ?>
                              </div>
                            </div>
                      <div class="row">
                        <div class="col-md-12 col-sm-12">
                          <span class="input-group-text">
                            <h4><b>Extra Conditions</b></h4>
                          </span>
                      </div> 
                    <div class="col-md-12 col-sm-12">
                        <?php
                          if(!($trip_condition_casual==1 || $trip_condition_physical==1 || $trip_condition_vegan==1 || $trip_condition_children==1 || $trip_condition_flexible==1 || $trip_condition_seasonal==1))
                          {
                            echo "<p>No additional conditions</p>";
                          }
                          else{
                            echo "<div class=\"row\">";
                            if($trip_condition_casual==1){
                              echo "<a href=\"#\"  data-toggle=\"tooltip\" data-placement=\"top\" title=\"Travelers need to wear appropriate outfits neutral colors, no sleeveless shirts and shorts.The dress code's featured most of these locations;temples, museum, or any official places.\">
                              <div class=\"col-md-4 col-sm-4\" align=\"center\">
                                  <input type='checkbox' name=\"smart_casual\" value=\"1\" disabled checked id=\"smart_casual\"/><label for=\"smart_casual\"></label> 
                              </div>
                              </a>";
                            }
                            if($trip_condition_physical==1){
                              echo "<a href=\"#\"  data-toggle=\"tooltip\" data-placement=\"top\" title=\"Travelers need to be fit and firm, so it will be easier for them to complete your trip. Select this condition, if your trip featured these following activities; boxing, hiking, trekking, kayaking, rafting, etc.\">
                              <div class=\"col-md-4 col-sm-4\" align=\"center\">
                               <input type='checkbox' name='physical_strength' disabled checked value='1' id=\"physical_strength\"/><label for=\"physical_strength\"></label> 
                              </div>
                            </a>";
                            }
                            if($trip_condition_vegan==1){
                              echo "<a href=\"#\"  data-toggle=\"tooltip\" data-placement=\"top\" title=\"Select this condition, if your trip has alternative choices for vegetable meals.\">
                              <div class=\"col-md-4 col-sm-4\" align=\"center\">
                                 <input type='checkbox' name='vegan' value='1' disabled checked id=\"vegan\"/><label for=\"vegan\"></label> 
                              </div>
                              </a>";
                            }
                            if($trip_condition_children==1){
                              echo "<a href=\"#\"  data-toggle=\"tooltip\" data-placement=\"top\" title=\"Any activities that travelers can enjoy with their family members and is good with kids, such as going to an amusement park, watching a performance, joining a pottery workshop, etc, can be considered to this condition.\">
                              <div class=\"col-md-4 col-sm-4\" align=\"center\">
                                  <input type='checkbox' name='children' value='1' disabled checked id=\"children\"/><label for=\"children\"></label> 
                              </div>
                            </a>";
                            }
                            if($trip_condition_flexible=1){
                              echo "<a href=\"#\"  data-toggle=\"tooltip\" data-placement=\"top\" title=\"Although you stick to your listed itinerary, your trip may be adjusted accordingly to your travelers.\">
                              <div class=\"col-md-4 col-sm-4\" align=\"center\">
                                  <input type='checkbox' name='flexible' value='1' disabled checked id=\"flexible\"/><label for=\"flexible\"></label> 
                              </div>
                            </a>";
                            }
                            if($trip_condition_seasonal==1){
                              echo "<a href=\"#\"  data-toggle=\"tooltip\" data-placement=\"top\" title=\"For any activities places of your trip can be accessed seasonally for example, trekking to the top of Khitchakut mountain, visiting a tropical fruit farm, sightseeing at a national park, and etc, please select this condition.\">
                              <div class=\"col-md-4 col-sm-4\" align=\"center\">
                                 <input type='checkbox' name='seasonal' value='1' disabled checked id=\"seasonal\"/><label for=\"seasonal\"></label> 
                              </div>
                              </a>";
                            }
                            echo "</div>";
                          }
                        ?>
                    

                    </div>
                    <div class="col-md-12 col-sm-12"> 
                    <hr>
                    </div>
                      </div>
                      </div>
                    </div>
                    <div class="row">
                  <div class="col-md-12 col-sm-12">
                          <span class="input-group-text">
                            <h4><b>Gallery</b></h4>
                          </span>
                      </div> 
                      <div class="demo-gallery">



    <ul id="lightgallery" class="list-unstyled row">
        <?php while($result=mysqli_fetch_array($traveTripsQuery,MYSQLI_ASSOC)) { ?>
            <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="img/1-375.jpg 375, img/1-480.jpg 480, img/1.jpg 800" data-src="upload/<?php echo $result['trip_photo_name']; ?>" data-sub-html="<h4>Fading Light</h4><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>" data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1">
                <a href="">
                    <img class="img-responsive" src="upload/<?php echo $result['trip_photo_name']; ?>" alt="Thumb-1">
                </a>
            </li>
        <?php } ?>
    </ul>
</div>
                      <div class="col-md-12 col-sm-12"> 
                    <hr>
                    </div>
                  </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sd-4">
                <div class="card card-pricing">
                  <div class="card-body" align="center">
                  <div class="form-group">
                       <h4><b>Trip Date</b></h4>
                    <div id="datePick"></div>
                  </div>
                    <h3 class="card-title" id="total_price">0.00<small>THB</small></h3>
                    <ul>
                        <li><p id="adult_price">0 Adults ( 0.00 THB )</p><br>
                          <button class="btn btn-fab btn-round btn-info" data-dir="dwn" (click)="adultNumberSpinner('down')" onclick="adultNumberSpinner('down');"> <i class="material-icons">remove</i> </button>
                          <button class="btn btn-fab btn-round btn-info" data-dir="up" (click)="adultNumberSpinner('up')" onclick="adultNumberSpinner('up');"> <i class="material-icons">add</i> </button>
                        </li>
                        <li>
                        <br>
                        <div *ngIf="childrenTraveler!=0; then thenBlock else elseBlock"></div>
                        <ng-template #thenBlock>
                        <p id="children_price">0 Children ( 0.00 THB )</p><br>
                          <button class="btn btn-fab btn-round btn-info" data-dir="dwn" (click)="childrenNumberSpinner('down')" onclick="childrenNumberSpinner('down');"> <i class="material-icons">remove</i> </button>
                          <button class="btn btn-fab btn-round btn-info" data-dir="up" (click)="childrenNumberSpinner('up')" onclick="childrenNumberSpinner('up');"> <i class="material-icons">add</i> </button></ng-template>
                        <ng-template #elseBlock></ng-template>
                        </li>
                        <li><button class="btn btn-warning btn-round" (click)="onReserved()">Book now</button></li>
                    </ul>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
  <?php include('footer.php'); ?>
  <!--   Core JS Files   -->
  <script src="./assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="./assets/js/plugins/moment.min.js"></script>
  <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
  <script src="./assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="./assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGat1sgDZ-3y6fFe6HD7QUziVC6jlJNog"></script>
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!--	Plugin for Sharrre btn -->
  <script src="./assets/js/plugins/jquery.sharrre.js" type="text/javascript"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="./assets/js/plugins/bootstrap-tagsinput.js"></script>
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="./assets/js/plugins/bootstrap-selectpicker.js" type="text/javascript"></script>
  <!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="./assets/js/plugins/jasny-bootstrap.min.js" type="text/javascript"></script>
  <!--	Plugin for Small Gallery in Product Page -->
  <script src="./assets/js/plugins/jquery.flexisel.js" type="text/javascript"></script>
  <!-- Plugins for presentation and navigation  -->
  <script src="./assets/demo/modernizr.js" type="text/javascript"></script>
  <script src="./assets/demo/vertical-nav.js" type="text/javascript"></script>
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Js With initialisations For Demo Purpose, Don't Include it in Your Project -->
  <script src="./assets/demo/demo.js" type="text/javascript"></script>
  <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/material-kit.js?v=2.1.1" type="text/javascript"></script>
  <script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/js/lightgallery.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-pager.js/master/dist/lg-pager.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-autoplay.js/master/dist/lg-autoplay.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-fullscreen.js/master/dist/lg-fullscreen.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-zoom.js/master/dist/lg-zoom.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-hash.js/master/dist/lg-hash.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-share.js/master/dist/lg-share.js"></script>
<script>
    lightGallery(document.getElementById('lightgallery'));
</script>
<script src="js/jquery-ui.multidatespicker.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script>
    function adultNumberSpinner(mode){
      if(mode=='up'){
        if (num_adult+num_children+1 > max_pass){
          alert("Exceed maximum passenger!!!!");
        }else{
          num_adult = num_adult+1;
          calculate_price();
        }
      }else if(mode=="down"){
        if(num_adult>=1){
          num_adult = num_adult-1;
          calculate_price();
        }
      }
    }
    function childrenNumberSpinner(mode){
      if(mode=='up'){
        if (num_adult+num_children+1 > max_pass){
          alert("Exceed maximum passenger!!!!");
        }else{
          num_children = num_children+1;
          calculate_price();
        }
      }else if(mode=="down"){
        if(num_children>=1){
          num_children = num_children-1;
          calculate_price();
        }
      }
    }
    function calculate_price(){
      var adult_price = 0.0;
      if(price_type=="basic"){
        adult_price = num_adult*unit1;
      }else{
        if(num_adult == 1){
          adult_price = total1;
        }else if(num_adult == 2){
          adult_price = total2;
        }else if(num_adult == 3){
          adult_price = total3;
        }else if(num_adult == 4){
          adult_price = total4;
        }else if(num_adult == 5){
          adult_price = total5;
        }else if(num_adult == 6){
          adult_price = total6;
        }else if(num_adult == 7){
          adult_price = total7;
        }else if(num_adult == 8){
          adult_price = total8;
        }
        var adult_text = num_adult+" Adults ("+adult_price+" THB)";
        $('#adult_price').html(adult_text);

        var children_price = num_children * price_children;
        var children_text = num_children+" Children ("+children_price+" THB)";
        $('#children_price').html(children_text);

        var total_price = adult_price + children_price;
        $('#total_price').html(total_price);

      }
    }
  </script>
  <script>
    var num_adult;
    var num_children;
    var price_children;
    var max_pass;
    var price_type;
    var unit1;
    var total1;
    var unit2;
    var total2;
    var unit3;
    var total3;
    var unit4;
    var total4;
    var unit5;
    var total5;
    var unit6;
    var total6;
    var unit7;
    var total7;
    var unit8;
    var total8;
    $(document).ready(function() {
      <?php 
        echo "availableDates = [";
        $first = true;
        foreach($date_array as $d){
          if(!$first){
            echo ",";
          }else{
            $first=false;
          }
          echo "'".$d."'";
        }
        echo "];";
      ?>
    function unavailable(date) {
        dmy =  ('0' + (date.getMonth() + 1)).slice(-2) + "/" + ('0' + date.getDate()).slice(-2) + "/" + date.getFullYear();
        if ($.inArray(dmy, availableDates) == -1) {
            return [false, "" , "Unavailable"];
        } else {
            return [true, ""];
        }
    }

      $('#datePick').datepicker({beforeShowDay: unavailable});
      num_adult = 0;
      num_children = 0;
    <?php echo "price_children=".$price_children.";"; ?>
    <?php echo "max_pass=".$price_max_pass.";"; ?>
    <?php echo "price_type='".$price_type."';"; ?>
    <?php echo "unit1=".$price_unit1.";"; ?>
    <?php echo "total1=".$price_total1.";"; ?>
    <?php echo "unit2=".$price_unit2.";"; ?>
    <?php echo "total2=".$price_total2.";"; ?>
    <?php echo "unit3=".$price_unit3.";"; ?>
    <?php echo "total3=".$price_total3.";"; ?>
    <?php echo "unit4=".$price_unit4.";"; ?>
    <?php echo "total4=".$price_total4.";"; ?>
    <?php echo "unit5=".$price_unit5.";"; ?>
    <?php echo "total5=".$price_total5.";"; ?>
    <?php echo "unit6=".$price_unit6.";"; ?>
    <?php echo "total6=".$price_total6.";"; ?>
    <?php echo "unit7=".$price_unit7.";"; ?>
    <?php echo "total7=".$price_total7.";"; ?>
    <?php echo "unit8=".$price_unit8.";"; ?>
    <?php echo "total8=".$price_total8.";"; ?>

      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-46172202-1']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
      })();

      // Facebook Pixel Code Don't Delete
      ! function(f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function() {
          n.callMethod ?
            n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
      }(window,
        document, 'script', '//connect.facebook.net/en_US/fbevents.js');

      try {
        fbq('init', '111649226022273');
        fbq('track', "PageView");

      } catch (err) {
        console.log('Facebook Track Error:', err);
      }

    });
  </script>
  <script>
  
  function myMap() {
    var x = document.getElementById("map");
    console.log(x);
    var mapProp= {
      <?php
        if(strlen($trip_meeting_lat) > 0 && strlen($trip_meeting_lng>0))
          echo "center:new google.maps.LatLng(".$trip_meeting_lat.", ".$trip_meeting_lng."),";
        else
          echo "center:new google.maps.LatLng(13.736717, 100.523186),";
      ?>
    
      zoom:15
    }
    var map=new google.maps.Map(document.getElementById("map"),mapProp);
    <?php
    if(strlen($trip_meeting_lat) > 0 && strlen($trip_meeting_lng>0))
    {
      echo "var position = new google.maps.LatLng(".$trip_meeting_lat.", ".$trip_meeting_lng.");";
      echo "placeMarker(position,map);";
    }

    ?>
    }
    function placeMarker(position, map) {
        marker = new google.maps.Marker({
        position: position,
        map: map
    
    });
    map.panTo(position);
    

  }

  
  </script>
      <!--  Google Maps Plugin    -->
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVlIZSpzYkePXCjcm9xRHuFyL2DbKZY0Q&callback=myMap&language=en&region=EN"></script>
 
  <noscript>
    <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=111649226022273&ev=PageView&noscript=1" />
  </noscript>
</body>

</html>