
<?php
  include('include/user.php');
  $user = new User();
?>
<!DOCTYPE html>  
 <html lang="en">  
 <head>  
   <title>Halawayz</title>  
   <meta charset="UTF-8">  
 </head>  
 <!-- Below is the initialization snippet for my Firebase project. It will vary for each project -->  
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>    
 <!--    ต้องมีการเรียกใช้งาน Google Platform Library ในหน้าที่มีการใช้งาน Google Sign In-->
 <script src="https://apis.google.com/js/platform.js" async defer></script>
 <script src="https://www.gstatic.com/firebasejs/3.6.4/firebase.js"></script>  
 <script>  
  // Initialize Firebase  
  var config = {  
    apiKey: 'AIzaSyAkrn_GV6YLwFhv8e3IXo8WalRqfkrUYcM',
            authDomain: 'halalwayz-server.firebaseapp.com',
            databaseURL: 'https://halalwayz-server.firebaseio.com',
            projectId: 'halalwayz-server',
            storageBucket: 'halalwayz-server.appspot.com',
            messagingSenderId: '866623462982'
  };  
  firebase.initializeApp(config);  
 </script>  
  <!-- A simple example script to add text to the page that displays the user's Display Name and Email -->  
  <script>  
 // Track the UID of the current user.  
 var currentUid = null;  
 firebase.auth().onAuthStateChanged(function(user) {  
  // onAuthStateChanged listener triggers every time the user ID token changes.  
  // This could happen when a new user signs in or signs out.  
  // It could also happen when the current user ID token expires and is refreshed.  
  if (user && user.uid != currentUid) {  
   // Update the UI when a new user signs in.  
   // Otherwise ignore if this is a token refresh.  
   // Update the current user UID.  
    currentUid = user.uid;  
    email = user.email;
    //console.log(email);
            //console.log("ID: " + profile.getId()); // google แนะนำว่าไม่ควรส่งคานี้ไปเก็บไว้บน server 
        // ค่า ID นี้เราสามรรถประยุกต์เพิ่มเติมตามต้องการ เช่นอาจจะเข้ารหัสก่อนบันทึกหรืออะไรก็ได้
        // แต่ในที่นี้จะใช้วิธีอยางง่่ายเพื่อเป็นแนวทาง
        //console.log('Full Name: ' + profile.getName());
        //console.log('Given Name: ' + profile.getGivenName());
        //console.log('Family Name: ' + profile.getFamilyName());
        //console.log("Image URL: " + profile.getImageUrl());
        //console.log("Email: " + profile.getEmail());
        /*
        user_id=".$_POST['ggid'].",
        first_name='".$_POST['first_name']."',
        last_name='".$_POST['last_name']."',
        picture='".$_POST['picture']."',
        email='".$_POST['email']."',
        */
    if(currentUid!=null){
      var firstName = user.displayName.split(' ').slice(0, -1).join(' ');
      var lastName = user.displayName.split(' ').slice(-1).join(' ');
      //console.log(firstName);
    $.post("checkuser.php", { email: email,ggid: user.uid,first_name:firstName,last_name:lastName,photo:user.photoURL })
    .done(function(data) {
        //alert("Data Loaded: " + data);
        window.location='index.php';  
    });
    }
    console.log(user);
   //document.body.innerHTML = '<h1> Congrats ' + user.displayName + ', you are done! </h1> <h2> Now get back to what you love building. </h2> <h2> Need to verify your email address or reset your password? Firebase can handle all of that for you using the email you provided: ' + user.email + '. <h/2>';  

   //window.location.href = "test.php";
  } else {  
   // Sign out operation. Reset the current user UID.  
   currentUid = null;  
   console.log("no user signed in");  
  }  
 });  
 </script>  
 </html>