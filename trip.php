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
          <h4><?php echo $trip_sum; ?></h4>
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
                <h3 class="title"><?php echo $firstname." ".$lastname; ?></h3>
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
                            <p><?php echo $trip_dest; ?></p><br/><hr>
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
                              MAP
                              </div>
                              <div class="row">
                              detailsssssss
                              </div>
                            </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sd-4">
                <div class="card card-pricing">
                  <div class="card-body ">
                  <div class="form-group">
                    <label class="label-control">Date Picker</label>
                    <input type="text" class="form-control datepicker" value="10/10/2016">
                  </div>
                    <h1 class="card-title">2,000<small>THB</small></h1>
                    <ul>
                        <li>Adult {{basicPrice}} x {{adultTraveler}} = {{basicPrice * adultTraveler}} THB<br>
                          <button class="btn btn-fab btn-round btn-info" data-dir="dwn" (click)="adultNumberSpinner('down')"> <i class="material-icons">remove</i> </button>
                          <button class="btn btn-fab btn-round btn-info" data-dir="up" (click)="adultNumberSpinner('up')"> <i class="material-icons">add</i> </button>

                        <br>
                        <div *ngIf="childrenTraveler!=0; then thenBlock else elseBlock"></div>
                        <ng-template #thenBlock>
                          Children {{childrenPrice}} x {{childrenTraveler}} = {{childrenPrice * childrenTraveler}} THB<br>
                          <button class="btn btn-fab btn-round btn-info" data-dir="dwn" (click)="childrenNumberSpinner('down')"> <i class="material-icons">remove</i> </button>
                          <button class="btn btn-fab btn-round btn-info" data-dir="up" (click)="childrenNumberSpinner('up')"> <i class="material-icons">add</i> </button></ng-template>
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
  <script>
    $(document).ready(function() {


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
  <noscript>
    <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=111649226022273&ev=PageView&noscript=1" />
  </noscript>
</body>

</html>