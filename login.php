<?php
    session_start();
    //require_once("functions.php");
    include('include/user.php');
    $user = new User();
?>
<!DOCTYPE html>  
 <html lang="en">  
  <head>  
   <title>Halalwayz</title>  
   <meta charset="UTF-8">  
 </head>  
 <!-- Below is the initialization snippet for my Firebase project. It will vary for each project -->  
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
 <!-- The code below initializes the sign-in widget from FirebaseUI web. -->  
 <script src="https://cdn.firebase.com/libs/firebaseui/1.0.0/firebaseui.js"></script>  
   <link type="text/css" rel="stylesheet" href="https://cdn.firebase.com/libs/firebaseui/1.0.0/firebaseui.css" />  
   <script type="text/javascript">  
    var uiConfig = {  
     signInSuccessUrl: 'loggedIn.php',  
     signInOptions: [  
      // Specify providers you want to offer your users.  
      firebase.auth.GoogleAuthProvider.PROVIDER_ID,  
      firebase.auth.EmailAuthProvider.PROVIDER_ID  
     ],  
     // Terms of service url can be specified and will show up in the widget.  
     tosUrl: '<your-tos-url>'  
    };  
    // Initialize the FirebaseUI Widget using Firebase.  
    var ui = new firebaseui.auth.AuthUI(firebase.auth());  
    // The start method will wait until the DOM is loaded.  
    ui.start('#firebaseui-auth-container', uiConfig);  
 </script>  
 <!-- Include a simple background image & and title -->  
  <div></div>  
  <body>  
       <h1 align="center" style="color:white;">Firebase Auth Quickstart Demo</h1>  
        <div id="firebaseui-auth-container"></div>  
  </body>  
 </html>  