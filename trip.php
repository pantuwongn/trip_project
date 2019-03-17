<?php
    session_start();
    require_once("config.php");
    require_once("functions.php");
    include('include/user.php');
    $user = new User();
    if ($conn->connect_errno) {
      echo $conn->connect_error;
      exit;
    }
    else
    {
      $sql="SELECT * FROM users WHERE user_id = '".$_SESSION["userID"]."' LIMIT 1";
      $result = $mysqli->query($sql); // ทำการ query คำสั่ง sql 
      $total=$result->num_rows; 
      $user=$result->fetch_object();
    }
    
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
</head>

<body class="profile-page sidebar-collapse">
  <?php include('header.php') ?>
  <div class="page-header header-filter header-small" data-parallax="true" style="background-image: url('../assets/img/bg9.jpg');">
    <div class="container">
      <div class="row">
        <div class="col-md-8 ml-auto mr-auto text-center">
          <h1 class="title">Trip name</h1>
          <h4>Trip shot description</h4>
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
                <img src="<?php echo $_SESSION['photoURL']; ?>" alt="Circle Image" class="img-raised rounded-circle img-fluid">
              </div>
              <div class="name">
                <h3 class="title">Trip owner</h3>
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
                    <p class="description">Trip content
                      <br>
                      <br>
                    </p>
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