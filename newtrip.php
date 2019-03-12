<?php
    session_start();
    require_once("functions.php");
    include('include/user.php');
    $user = new User();

    $_SESSION['trip_id'] = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="favicon.ico">
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
  <link href='dropzone.css' type='text/css' rel='stylesheet'>
  <link rel="stylesheet" href="dist/mtr-datepicker.min.css">
  <link rel="stylesheet" href="dist/mtr-datepicker.default-theme.min.css">
  <link rel="stylesheet" href="css/nice-select.css">
</head>

<body class="normal-page sidebar-collapse">
  <?php include('header.php') ?>
  <div class="page-header header-filter clear-filter">
  </div>
  <div class="main main-raised">
    <div class="section section-basic">
      <div class="container">
        <div class="title">
            <h2>New trip</h2>
        </div>  
        <div class="col-lg-12 col-md-12">
              <div class="row">
                <div class="col-md-2">
                  <ul class="nav nav-pills nav-pills-icons" role="tablist">
                    <!--
                        color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger"
                    -->
                    <li class="nav-item">
                      <a class="nav-link active" href="#basic" role="tab" data-toggle="tab" id="basicTab">
                         Basic
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#overview" role="tab" data-toggle="tab" id="overviewTab">
                         Overview
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#detail" role="tab" data-toggle="tab" id="detailTab">
                         Detail
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#price" role="tab" data-toggle="tab" id="priceTab">
                         Price
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#conditions" role="tab" data-toggle="conditionTab">
                         Conditions
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#submit" role="tab" data-toggle="submitTab">
                         Submit
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="col-md-10">
                  <div class="tab-content">
                    <div class="tab-pane active" id="basic">
                      <div id="file-uploader">
                        <div class="row">
                          <div class="col-md-5 col-sm-8">
                            <h4>Cover Image</h4>
                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                              <div class="fileinput-new thumbnail img-raised">
                                <img src="./assets/img/image_placeholder.jpg" alt="...">
                              </div>
                              <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                              <div>
                                <span class="btn btn-raised btn-round btn-default btn-file">
                                  <span class="fileinput-new">Select image</span>
                                  <span class="fileinput-exists">Change</span>
                                  <input type="file" name="..." id="cover" />
                                </span>
                                <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                              </div>
                            </div>
                            <form>
                              <div class="cc-selector">
                                <input [(ngModel)]="vehicle" class="form-check-input" checked="checked" id="walk" type="radio"
                                  name="vehicle" value="walk" />
                                <label class="drinkcard-cc walk" for="walk"></label>
                                <input [(ngModel)]="vehicle" class="form-check-input"  id="car" type="radio"
                                  name="vehicle" value="car" />
                                <label class="drinkcard-cc car" for="car"></label>
                                <input [(ngModel)]="vehicle" class="form-check-input" type="radio" name="vehicle" id="van"
                                  value="van" />
                                <label class="drinkcard-cc van" for="van"></label>
                                <input [(ngModel)]="vehicle" class="form-check-input" type="radio" name="vehicle" id="motorbike"
                                  value="motorbike" />
                                <label class="drinkcard-cc motorbike" for="motorbike"></label>
                                <input [(ngModel)]="vehicle" class="form-check-input" type="radio" name="vehicle" id="bike"
                                  value="bike" />
                                <label class="drinkcard-cc bike" for="bike"></label>
                                <input [(ngModel)]="vehicle" class="form-check-input" type="radio" name="vehicle" id="boat"
                                  value="boat" />
                                <label class="drinkcard-cc boat" for="boat"></label>
                                <input [(ngModel)]="vehicle" class="form-check-input" type="radio" name="vehicle" id="public"
                                  value="public" />
                                <label class="drinkcard-cc public" for="public"></label>
                              </div>
                            </form>
                          </div>
                          <div class="col-md-7 col-sm-7">
                                <div class="row">
                                  <div class="col-md-3 col-sm-3 col-lg-3 form-check">
                                    <label class="form-check-label">
                                      <input [(ngModel)]="triptype" class="form-check-input" type="radio" name="triptype" id="travel_trip"
                                        value="Travel trip" checked required />
                                      Travel trip
                                      <span class="circle">
                                        <span class="check"></span>
                                      </span>
                                    </label>
                                  </div>
                                  <div class="col-md-3 col-sm-3 col-lg-3 form-check">
                                    <label class="form-check-label">
                                      <input [(ngModel)]="triptype" class="form-check-input" type="radio" name="triptype" id="business_trip"
                                        value="Business trip" required />
                                      Business trip
                                      <span class="circle">
                                        <span class="check"></span>
                                      </span>
                                    </label>
                                  </div>
                                  <div class="col-md-3 col-sm-3 col-lg-3 form-check">
                                    <label class="form-check-label">
                                      <input [(ngModel)]="triptype" class="form-check-input" type="radio" name="triptype" id="medical_trip"
                                        value="Medical trip" required />
                                      Medical trip
                                      <span class="circle">
                                        <span class="check"></span>
                                      </span>
                                    </label>
                                  </div>
                                  <div class="col-md-3 col-sm-3 col-lg-3 form-check">
                                    <label class="form-check-label">
                                      <input [(ngModel)]="triptype" class="form-check-input" type="radio" name="triptype" id="umrah_trip"
                                        value="Umrah trip" required />
                                      Umrah trip
                                      <span class="circle">
                                        <span class="check"></span>
                                      </span>
                                    </label>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="material-icons">bookmark_border</i>
                                      </span>
                                    </div>
                                    <input [(ngModel)]="tripname" type="text" class="form-control" placeholder="Trip name" id="trip_name" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="form-group">
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <i class="material-icons">assignment</i>
                                        </span>
                                      </div>
                                      <textarea [(ngModel)]="tripsummary" maxlength="150" class="form-control" rows="5"
                                        placeholder="Trip summary" id="trip_sum" required></textarea>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="material-icons">place</i>
                                      </span>
                                    </div>
                                    <input [(ngModel)]="destination" type="text" class="form-control" placeholder="Trip to" id="trip_dest" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="material-icons">assistant</i>
                                      </span>
                                    </div>
                                    <input [(ngModel)]="tripactivity" type="text" class="form-control" id="trip_activity" placeholder="Activity (e.g. Shopping,Eating,Diving)" />
                                  </div>
                                </div>
                                <div class="text-center">
                                  <a (click)="newTrip()" class="btn btn-success btn-round float-right" onclick='newtrip_basic()'>Save</a>
                                </div>
                                <div class="text-center">
                                  <a [routerLink]="['/gtrips']" routerLinkActive="active" class="btn btn-success btn-round float-right" onclick="backFromBasic()">Back</a>
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                    <div class="tab-pane" id="overview">
                    <div class="col-md-12 col-sm-12">
                     <span class="input-group-text">
                           <i class="material-icons">insert_photo</i> <h4>Photos</h4>
                      </span>
                      <p>Please upload photos to represent trip overview.</p>
                      <div class='content'>
                          <form action="upload_handler.php" class="dropzone" id="dropzonewidget">
 
                        </form> 
                      </div> 
                         <div class="text-center">
                                  <a (click)="newTrip()" class="btn btn-success btn-round float-right" onclick='newtrip_overview()'>Save</a>
                         </div>
                        <div class="text-center">
                           <a [routerLink]="['/gtrips']" routerLinkActive="active" class="btn btn-success btn-round float-right" onclick="backFromOverview()">Back</a>
                        </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="detail">
                      <div class="row">
                        <span class="input-group-text">
                          <i class="material-icons">map</i>  <h4>Meeting Point</h4>
                        </span>
                      </div>
                      <div class="row">
                        <p>Please choose your meeting location in the first day of your trip.</p>
                        <div class="col-md-12 col-sm-12">
                           <div id="map" style="height:400px; margin:0px;"></div>
                          <textarea type="text" class="form-control" id="meeting_addr" /></textarea> Address of Meeting Point
                          <input type="text" class="form-control" id="meeting_lat" hidden />
                          <input type="text" class="form-control" id="meeting_lng" hidden />
                        </div>
                      </div>
                      <div class="row">
                        <span class="input-group-text">
                          <i class="material-icons">local_activity</i>  <h4>Trip Detail</h4>
                        </span>
                      </div>
                      <div class="col-md-12 col-sm-12">
                        <div class="container" id="allDays">
                          <div class="container" style="border: 1px solid black;">
                            <div class="row" style="margin:5px">
                              <h6>Detail for Day 1</h6>
                            </div>
                            <div class="container" id="detail1">
                            <div class="row" style="margin:2px;">
                                <div class="col-sm-3"><input class="form-control" type="time" id="detail1-1-s" name="detail1-1-s">Start Time</div>                        
                                <div class="col-sm-3"><input class="form-control" type="time" id="detail1-1-e" name="detail1-1-e">End Time</div>     
                                <div class="col-sm-6"><textarea  type="text" class="form-control" id="detail1-1-t" rows="1"></textarea>Description</div>
                            </div>
                            </div>
                            <div align="right">
                              <br/>
                              <button type="button" class="btn btn-primary btn-sm" id="addPeriod-1" onclick="addPeriod(1,1);">More Period</button>
                            </div>
                          </div>
                        </div>
                        <div align="right">
                            <br/>
                            <button type="button" class="btn btn-primary btn-sm" id="addDay" onclick="addDay();">More Day</button>
                          </div>
                      </div>
                      <div class="col-md-12 col-sm-12" >
                        <br>
                        <div align="right">
                            <div class="text-center">
                                  <a (click)="newTrip()" class="btn btn-success btn-round float-right" onclick='newtrip_detail()'>Save</a>
                            </div>
                            <div class="text-center">
                                  <a [routerLink]="['/gtrips']" routerLinkActive="active" class="btn btn-success btn-round float-right" onclick="backFromDetail()">Back</a>
                            </div>
                        </div>
                      </div>
                    </div>

                    <div class="tab-pane" id="price">
                    <div class="row">
                        <span class="input-group-text">
                          <i class="material-icons">attach_money</i>  <h4>Price</h4>
                        </span>
                        <br>
                        <p>Please, use these price conditions as guides to calculate your trip fee and always make sure to inform your travelers about any additional expenses before the trip day.</p><br/>
                      </div>
                    <div  class="col-md-12 col-sm-12">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="price" id="food_included" value="food_included" checked onclick="setPriceText('include');"> All Inclusive
                              <span class="circle">
                                <span class="check"></span>
                             </span>
                          </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="radio" name="price" id="food_excluded" value="food_excluded" onclick="setPriceText('exclude');" > Food Excluded
                            <span class="circle">
                              <span class="check"></span>
                            </span>
                          </label>
                      </div>
                      <div class=container id='price_text'>
                      <i class="material-icons">local_dining</i>&nbsp;<i class="material-icons">subway</i>&nbsp;<i class="material-icons">local_offer</i>
                        <p>Expenses, occur during a trip, are mainly included <br/>                     
                          - Public or private transportation fares : taxi, bts, mrt, etc.(Please estimate the cost of gasoline or vehicle rental fee, in case of using a private car) <br/>
                          - Foods; Meal(s) during the trip. (Please note that alcohol is always excluded) <br/>
                          - Admission fee: Amusement park, gallery, shows, and etc.
                        </p>
                      </div>
                      <hr>
                      <div class="row">
                        <span class="input-group-text">
                          <i class="material-icons">attach_money</i>  <h4>Extra expense travelers should prepare</h4>
                        </span>
                        <br>
                        <p>Are there any extra expenses that travelers have to pay during the trip?</p>
                      </div>
                        
                        <div class="col-md-12 col-sm-12" >
                          <br/>
                          <textarea type="text" class="form-control" id="extra_expense" placeholder="e.g. your pocket money" /></textarea> 
                        </div>
                        <hr>
                     <div class="row">
                     <div class="col-md-12 col-sm-12" >
                        <span class="input-group-text">
                          <i class="material-icons">people</i>  <h4>Maximum travelers</h4>
                        </span>
                      </div>
                      <div class="col-md-12 col-sm-12">
                          <select id="num_travelers" onchange="change_num_pass();">
                              <option value="1">1 Person </option>
                              <option value="2">2 Person</option>
                              <option value="3">3 Person</option>
                               <option value="4">4 Person</option>
                               <option value="5">5 Person</option>
                              <option value="6">6 Person</option>
                              <option value="7">7 Person</option>
                               <option value="8">8 Person</option>
                          </select>
                      </div> 
                      </div>
                      <hr> 
                      <div class="row">
                        <span class="input-group-text">
                          <i class="material-icons">attach_money</i>  <h4>Pricing Method</h4>
                        </span>
                        <br>
                      </div>
                      <div class="row">
                      <div class="col-md-12 col-sm-12">
                      <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="price_type" id="basic_price" value="basic_price" checked onclick="setPriceCal('basic');"> Basic Pricing
                              <span class="circle">
                                <span class="check"></span>
                             </span>
                          </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="radio" name="price_type" id="advance_price" value="advance_price" onclick="setPriceCal('advance');" > Advance Pricing
                            <span class="circle">
                              <span class="check"></span>
                            </span>
                          </label>
                      </div>
                      </div>
                      <div class="col-md-6 col-sm-6">
                        <div class="container" id="price_cal">
                          <div class="card">
                            <div class="card-content">
                              <div class="row" style="margin:2px;">
                                <div class="col-md-6 col-sm-6"><input class="form-control" type="text" id="price_per_basic" placeholder="0.00" oninput="calculateBasic();">Price/Person</div>
                                <div class="col-md-6 col-sm-6"><div id="total_basic">0.00 - 0.00</div>&nbsp;THB (Total/Trip)</div>
                              </div>
                            </div>
                          </div>  
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6">
                        <div class="card" >
                          <div class="card-content" align="center" >
                            <div class="container">
                          <i class="material-icons">highlight</i>  1,000 - 1,600 THB <br/>
                              Price (per person) <hr>

is recommended for an all-inclusive trip. The price range (shown above) is only the guideline to get higher booking rate. However, you are free to set your own price.
                            </div>
                          </div>
                        </div>
                      </div>                     
                      </div>
                      </div>
                      <div class="col-md-12 col-sm-12" >
                        <br>
                        <div align="right">
                            <div class="text-center">
                                  <a (click)="newTrip()" class="btn btn-success btn-round float-right" onclick='newtrip_price()'>Save</a>
                            </div>
                            <div class="text-center">
                                  <a [routerLink]="['/gtrips']" routerLinkActive="active" class="btn btn-success btn-round float-right" onclick="backFromPrice()">Back</a>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="conditions">
                      Conditions content
                      <br>
                      <br>Dramatically maintain clicks-and-mortar solutions without functional solutions.
                    </div>
                    <div class="tab-pane" id="submit">
                      Submit content
                      <br>
                      <br>Dramatically maintain clicks-and-mortar solutions without functional solutions.
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
  <script src='dropzone.js' type='text/javascript'></script>
  <script src="js/jquery.nice-select.js"></script>
 
  <!-- first tab: basic -->
  <script>


    function backFromBasic(){
      window.location="myprofile.php";
    }

    function getTripTypeId(){
      tripTypeId = 0;
      if ($('#travel_trip:checked').val()){
        tripTypeId = 1;
      }else if($('#business_trip:checked').val()){
        tripTypeId = 2;
      }else if($('#medical_trip:checked').val()){
        tripTypeId = 3;
      }else if($('#umrah_trip:checked').val()){
        tripTypeId = 4;
      }
      return tripTypeId;
    }
    function getVehicleId(){
      vehicleId = 0;
      if ($('#walk:checked').val()){
        vehicleId = 1;
      }else if($('#car:checked').val()){
        vehicleId = 2;
      }else if($('#van:checked').val()){
        vehicleId = 3;
      }else if($('#motorbike:checked').val()){
        vehicleId = 4;
      }else if($('#bike:checked').val()){
        vehicleId = 5;
      }else if($('#boat:checked').val()){
        vehicleId = 6;
      }else if($('#public:checked').val()){
        vehicleId = 7;
      }
      return vehicleId;
    }

    function newtrip_basic(){
      var input = document.getElementById("cover");
      if (!input) {
        alert("Um, couldn't find the fileinput element.");
      }
      else if (!input.files) {
        alert("This browser doesn't seem to support the `files` property of file inputs.");
      }
      else if (!input.files[0]) {
        alert("Please select a file before clicking 'Load'");               
      }
      else {
        var file_data = input.files[0];
        var form_data = new FormData();                  
        form_data.append('file', file_data);                         
        $.ajax({
          url: 'upload_handler.php', 
          dataType: 'text',  // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,                         
          type: 'post',
          success: function(php_script_response){
            if (php_script_response.length <=2){
              alert('Cannot upload cover photo!!');
            }else{
              users_user_id = "<?php echo $_SESSION["userID"];?>";
              vehicleId = getVehicleId();
              tripTypeId = getTripTypeId();
              cover = php_script_response;
              tripName = $('#trip_name').val();
              tripSum = $('#trip_sum').val();
              tripDest = $('#trip_dest').val();
              tripAct = $('#trip_activity').val();

              var form_basic = new FormData()
              form_basic.append('users_user_id',users_user_id);
              form_basic.append('trip_type_id',tripTypeId);
              form_basic.append('vehicle_id',vehicleId);
              form_basic.append('trip_name',tripName);
              form_basic.append('trip_sum',tripSum);
              form_basic.append('trip_dest',tripDest);
              form_basic.append('trip_activity',tripAct);
              form_basic.append('trip_cover',cover);
              form_basic.append('tab','basic');
              $.ajax({
                 url: 'newtrip_backend.php', 
                 dataType: 'text',  // what to expect back from the PHP script, if anything
                 cache: false,
                 contentType: false,
                 processData: false,
                data: form_basic,                         
                type: 'post',
                success: function(msg){
                  if (msg.length<10){
                    $('#basicTab').removeClass('active');
                    $('#basic').removeClass('active');
                    $('#overviewTab').addClass('active');
                    $('#overview').addClass('active');
                  }else{
                    alert("Error: " + msg);
                  }
                }
              });

            }
          }
         });
      }  
    }

  </script>

 <!-- second tab: overview -->
  <script>
    var dict = {};
    Dropzone.autoDiscover = false;

  var dropzone = new Dropzone ("#dropzonewidget", {
    maxFilesize: 256, // Set the maximum file size to 256 MB
    addRemoveLinks: true, // Don't show remove links on dropzone itself.
  });

  dropzone.on("removedfile", function(file){
    $.ajax({
        url: "delete_file.php",
        type: "POST",
        data: { "filename" : dict[file.name] },
        success: function(msg){
          //alert(msg);
        }
    });
  });

  dropzone.on("success", function(file,response){
    dict[file.name] = response;
  });

    function backFromOverview(){
      $('#basicTab').addClass('active');
      $('#basic').addClass('active');
      $('#overviewTab').removeClass('active');
      $('#overview').removeClass('active');
    }

    function newtrip_overview(){
  
      fileArr = new Array();
      for(var key in dict) {
	  var value = dict[key];
 	  fileArr.push(value);	
      }

      var form_overview = new FormData()
      form_overview.append('fileList',JSON.stringify(fileArr));
      form_overview.append('tab','overview')
      $.ajax({
          url: 'newtrip_backend.php', 
          dataType: 'text',  // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_overview,                   
          type: 'post',
          success: function(msg){
            if (msg.length<10){
                $('#overviewTab').removeClass('active');
                $('#overview').removeClass('active');
                $('#detailTab').addClass('active');
                $('#detail').addClass('active');
            }else{
                alert("Error: " + msg);
            }
          }
        });
    }
  </script>

 <!-- third tab: detail -->
<script>

    function backFromDetail(){
      $('#overviewTab').addClass('active');
      $('#overview').addClass('active');
      $('#detailTab').removeClass('active');
      $('#detail').removeClass('active');
    }

    function newtrip_detail(){
      var meeting_addr = $('#meeting_addr').val();
      var meeting_lat = $('#meeting_lat').val();
      var meeting_lng = $('#meeting_lng').val();

      var numDay = Object.keys(detailArr).length;
      var detail_data = {}
      for(var day = 1; day<=numDay; day++){
          detail_data[day] = {};
          for (var det=1; det<=detailArr[day].length; det++)
          {
            var temp = {};
            var sId = "#detail"+day.toString()+"-"+det.toString()+"-s";
            var eId = "#detail"+day.toString()+"-"+det.toString()+"-e";
            var tId = "#detail"+day.toString()+"-"+det.toString()+"-t";
            temp['start'] = $(sId).val();
            temp['end'] = $(eId).val();
            temp['desc'] = $(tId).val();
            detail_data[day][det] = temp;
          }
      }
    
      var stringData = JSON.stringify( detail_data );

      var form_detail = new FormData()
      form_detail.append('meeting_addr', meeting_addr);
      form_detail.append('meeting_lat', meeting_lat);
      form_detail.append('meeting_lng', meeting_lng);
      form_detail.append('num_day', numDay);
      form_detail.append('trip_detail_data',stringData);
      form_detail.append('tab','detail')
      $.ajax({
          url: 'newtrip_backend.php', 
          dataType: 'text',  // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_detail,                   
          type: 'post',
          success: function(msg){
            console.log(msg);
            if (msg.length<10){
                $('#detailTab').removeClass('active');
                $('#detail').removeClass('active');
                $('#priceTab').addClass('active');
                $('#price').addClass('active');
            }else{
                //alert("Error: " + msg);
            }
          }
        });
    }

  function addPeriod(d,p){
    console.log(detailArr);
    var wrapperId = 'detail'+d.toString();
    var wrapper = $('#'+wrapperId);
    var sId = "detail"+d.toString()+"-"+(p+1).toString()+"-s";
    var eId = "detail"+d.toString()+"-"+(p+1).toString()+"-e";
    var tId = "detail"+d.toString()+"-"+(p+1).toString()+"-t";
    var fields = "<div class=\"row\" style=\"margin:2px\"><div class=\"col-sm-3\"><input class=\"form-control\" type=\"time\" id="+sId+" name="+sId+">Start Time</div><div class=\"col-sm-3\"><input class=\"form-control\" type=\"time\" id="+eId+" name="+eId+">End Time</div><div class=\"col-sm-6\"><textarea class=\"form-control\" id="+tId+" rows=\"1\"></textarea>Description</div></div>"
    $(wrapper).append(fields)
    detailArr[d].push(p+1);
    console.log(detailArr)
    var buttonId = "addPeriod-"+d.toString();
    var newP = p+1
    document.getElementById( buttonId ).setAttribute( "onClick", "javascript: addPeriod("+d.toString()+","+newP.toString()+");" );

  }
  function addDay(d){
    console.log(detailArr);
    var currentDay = Object.keys(detailArr).length;
    var newDay = currentDay+1;
    var buttonId = "addPeriod-"+newDay.toString();
    var funcName = "addPeriod("+newDay.toString()+",1);"
    var newId = "detail"+newDay.toString();
    var sId = "detail"+newDay.toString()+"-1-s";
    var eId = "detail"+newDay.toString()+"-1-e";
    var tId = "detail"+newDay.toString()+"-1-t";
    var wrapper = $('#allDays');
    var fields = "<br><div class=\"container\" style=\"border: 1px solid black;\"><div class=\"row\" style=\"margin:5px\"><h6>Detail for Day "+newDay.toString()+"</h6></div><div class=\"container\" id="+newId+"><div class=\"row\" style=\"margin:2px\"><div class=\"col-sm-3\"><input class=\"form-control\" type=\"time\" id="+sId+" name="+sId+">Start Time</div><div class=\"col-sm-3\"><input class=\"form-control\" type=\"time\" id="+eId+" name="+eId+">End Time</div><div class=\"col-sm-6\"><textarea class=\"form-control\" id="+tId+" rows=\"1\"></textarea>Description</div></div></div><div align=\"right\"><br/><button type=\"button\" class=\"btn btn-primary btn-sm\" id="+buttonId+" onclick="+funcName+">More Period</button></div></div>";
    $(wrapper).append(fields);
    detailArr[newDay] = new Array();
    detailArr[newDay].push(1);
    console.log(detailArr);


  }
  function myMap() {
    var x = document.getElementById("map");
    console.log(x);
    var mapProp= {
   
      center:new google.maps.LatLng(13.736717, 100.523186),
      zoom:5
    }
    var map=new google.maps.Map(document.getElementById("map"),mapProp);
    var isClick=false;
    map.addListener('click', function(e) {
      if(!isClick){
          placeMarker(e.latLng, map);
          isClick=true;
      }
    });
  }
    function placeMarker(position, map) {
        var marker = new google.maps.Marker({
        position: position,
        map: map
    });
    map.panTo(position);
    marker.setDraggable(true);
    var x = document.getElementById("meeting_lat");
var y = document.getElementById("meeting_lng");
    
        x.value = marker.getPosition().lat();
    y.value = marker.getPosition().lng();
    latlngChange();
    
google.maps.event.addListener( marker, 'click', function ( event ) {
    x.value = this.getPosition().lat();
    y.value = this.getPosition().lng();
    latlngChange();
} );  
google.maps.event.addListener( marker, 'dragend', function ( event ) {
    x.value = this.getPosition().lat();
    y.value = this.getPosition().lng();
    latlngChange();
} );  
  }

  function latlngChange()
    {
        var x = document.getElementById("meeting_lat");
        var y = document.getElementById("meeting_lng")
        var place1 = document.getElementById("meeting_addr");

        var geocoder = new google.maps.Geocoder;
    
        var latlng = {lat: parseFloat(x.value), lng: parseFloat(y.value)};

        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
              place1.value = results[0].formatted_address;
            } else {
            place1.value ="No address detail";
            }
          } else {
            window.alert('Geocoder failed due to: ' + status);
          }
        });
      }

</script>
<!-- fourth tab: price -->
<script>
    function backFromPrice(){
      $('#detailTab').addClass('active');
      $('#detail').addClass('active');
      $('#priceTab').removeClass('active');
      $('#price').removeClass('active');
    }

    function newtrip_price(){
      var food_price = 'included';
      if($('#food_excluded:checked').val()){
          food_price = 'excluded'
      }
      var extra_expense = $('#extra_expense').val();
      var max_pass = $('#num_travelers').val();
      var price_type = 'basic';
      if($('#advance_price:checked').val()){
        price_type = 'advance'
      }
      var total_price = Array();
      var unit_price = Array();
      if (price_type === 'basic'){
        var u = $('#price_per_basic').val();
        var t = u*max_pass;
        unit_price.push(u);
        total_price.push(t);
      }else{
        for(var i=1;i<=max_pass;i++){
          var u =  $('#price_per_adv-'+i.toString()).val();
          var t = i*u;
          unit_price.push(u);
          total_price.push(t);
        }
      }

    }

  function setPriceText(t)
  {
    if(t==='include'){
      var text =  "<i class=\"material-icons\">local_dining</i>&nbsp;<i class=\"material-icons\">subway</i>&nbsp;<i class=\"material-icons\">local_offer</i><p>Expenses, occur during a trip, are mainly included <br/> - Public or private transportation fares : taxi, bts, mrt, etc.(Please estimate the cost of gasoline or vehicle rental fee, in case of using a private car) <br/> - Foods; Meal(s) during the trip. (Please note that alcohol is always excluded) <br/> - Admission fee: Amusement park, gallery, shows, and etc.</p>";
      document.getElementById("price_text").innerHTML = text;
    }else{
      var text =  "<i class=\"material-icons\">local_dining</i>&nbsp;<i class=\"material-icons\">local_offer</i><br/><p>Travelers pay for their meal(s) during a trip. Only the following expenses are included. <br/> Reminder; Local Experts should calculate your trip’s price including these two expenses <br/> - Public or private transportation fares : taxi, bts, mrt, etc.(Please estimate the cost of gasoline or vehicle rental fee, in case of using a private car)  <br/> - Admission fee: Amusement park, gallery, shows, and etc.</p>";
      document.getElementById("price_text").innerHTML = text;
    }
  }
  
  function setPriceCal(t)
  {
    if(t==='basic'){
      var text="<div class=\"card\"><div class=\"card-content\"><div class=\"row\" style=\"margin:2px;\"><div class=\"col-md-6 col-sm-6\"><input class=\"form-control\" type=\"text\" id=\"price_per_basic\" placeholder=\"0.00\" oninput=\"calculateBasic();\">Price/Person</div><div class=\"col-md-6 col-sm-6\"><div id=\"total_basic\">0.00 - 0.00</div>&nbsp;THB (Total/Trip)</div></div></div></div>"
     
      $('#price_cal').html(text);
      calculateBasic();  
    }else{
      var max_pass = $('#num_travelers').val();
      var text="<div class=\"card\"><div class=\"card-content\"><div class=\"row\" style=\"margin:2px;\">";
      
      for(var i=1;i<=max_pass;i++){
        text= text+"<div class=\"col-md-3 col-sm-3\">"+i.toString()+"x<i class=\"material-icons\">person</i></div><div class=\"col-md-5 col-sm-5\"><input class=\"form-control\" type=\"text\" id=\"price_per_adv-"+i.toString()+"\" placeholder=\"0.00\" oninput=\"calculateAdvance("+i.toString()+");\">Price/Person</div><div class=\"col-md-4 col-sm-4\"><div id=\"total_adv-"+i.toString()+"\">0.00 - 0.00</div>&nbsp;THB</div>";
      }
      
      
      text= text+"</div></div></div>";
      $('#price_cal').html(text);

    }
  }

  function calculateBasic(){
    var max_pass = $('#num_travelers').val();
    var unit_price = $('#price_per_basic').val();
    var total_basic_text = (Number(unit_price).toFixed(2)).toString()+" - "+Number (max_pass * unit_price).toFixed(2).toString();
    $('#total_basic').html(total_basic_text);

  }
  
  function calculateAdvance(i){
    var unit_price_id = '#price_per_adv-'+i.toString();
    var unit_price = $(unit_price_id).val();
    var total_adv_text = Number (i * unit_price).toFixed(2).toString();
    $('#total_adv-'+i.toString()).html(total_adv_text);
  }

  function change_num_pass(){
    if($('#basic_price:checked').val()){
      setPriceCal('basic');
    }
    else{
      setPriceCal('advance');
    }
    $max_pass = $('#num_travelers').val();
    if($('#basic_price:checked').val()){
        calculateBasic();
    }
  }
</script>

  <script>  
    var detailArr = {};
    $(document).ready(function() {
      $(document).ready(function() {
  $('select').niceSelect();
});
      
      detailArr[1] = new Array();
      detailArr[1].push(1);

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
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVlIZSpzYkePXCjcm9xRHuFyL2DbKZY0Q&callback=myMap"></script>
  <noscript>
    <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=111649226022273&ev=PageView&noscript=1" />
  </noscript>
</body>

</html>
