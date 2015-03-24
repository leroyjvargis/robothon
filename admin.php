<?php include "base.php"; ?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="Robothon">
    <meta name="author" content="CEC WebTeam">

    <title>Register for Robothon</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />

    <!-- Custom Google Web Font -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>
    
    <!-- Custom CSS-->
    <link href="css/general.css" rel="stylesheet">

    
     <!-- Owl-Carousel -->
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    
    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="css/magnific-popup.css"> 
    
    <link rel="shortcut icon" href="img/favicon.ico">

    <script src="js/modernizr-2.6.2.min.js"></script>  <!-- Modernizr /-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src = "js/bootbox.min.js"></script>

</head>

<body>

    <div id="downloadlink" class="banner">    
    <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center wrap_title">
                <h2>Robothon</h2>
                <p class="lead" style="margin-top:0">A Robotic Hackathon</p>
                
             </div>
            </div>
        </div>
    </div>
<?php

if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
{
        $username = $_SESSION['Username'];
        $user = mysqli_query($link, "SELECT UserID FROM users WHERE Username = '".$username."'");
 //       $userID = mysqli_fetch_array($user);
   //     $userIDn = $userID['UserID'];

?>
<table class="container" border="1">
    <thead>
        <tr>
            <th><h4>Team Name</h4></th>
            <th><h4>Name</h4></th>
            <th><h4>Email Address</h4></th>
            <th><h4>College</h4></th>
            <th><h4>Year</h4></th>
            <th><h4>Branch</h4></th>
            <th><h4>Phone</h4></th>
            <th><h4>Section</h4></th>
            <th><h4>Member of</h4></th>
            <th><h4>IEEE Number</h4></th>
            <th><h4>Attending for</h4></th>
            <th><h4>Accomodation</h4></th>
            <th><h4>Food</h4></th>
            <th><h4>Total Amount</h4></th>
        </tr>
    </thead>
    <tbody>

<?php

    $result = mysqli_query($link, "SELECT * FROM registered");
    $no_reg = mysqli_num_rows($result);
    while($pos = mysqli_fetch_assoc($result))
    {
        
?>
        <tr>
            <td><p style="font-size:11px"><?php echo $pos['TeamName']; ?></p></td>
            <td><p style="font-size:11px"><?php echo $pos['Name']; ?></p></td>
            <td><p style="font-size:11px"><?php echo $pos['EmailAddress']; ?></p></td>
            <td><p style="font-size:11px"><?php echo $pos['College']; ?></p></td>
            <td><p style="font-size:11px"><?php echo $pos['Year']; ?></p></td>
            <td><p style="font-size:11px"><?php echo $pos['Branch']; ?></p></td>
            <td><p style="font-size:11px"><?php echo $pos['Phone']; ?></p></td>
            <td><p style="font-size:11px"><?php echo $pos['Section']; ?></p></td>
            <td><p style="font-size:11px"><?php echo $pos['Member']; ?></p></td>
            <td><p style="font-size:11px"><?php echo $pos['IEEENo']; ?></p></td>
            <td><p style="font-size:11px"><?php echo $pos['Attendance']; ?></p></td>
            <td><p style="font-size:11px"><?php echo $pos['Accomodation']; ?></p></td>
            <td><p style="font-size:11px"><?php echo $pos['Food']; ?></p></td>
            <td><p style="font-size:11px"><?php echo $pos['TotalAmount']; ?></p></td>
        </tr>
    </tbody>
<?php
    
}

?>

</table>    
  
 <?php
}
elseif(!empty($_POST['username']) && !empty($_POST['password']))
{
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = md5(mysqli_real_escape_string($link, $_POST['password']));
     
    $checklogin = mysqli_query($link, "SELECT * FROM admin WHERE Username = '".$username."' AND Password = '".$password."'");
     
    if(mysqli_num_rows($checklogin) == 1)
    {
       
        $_SESSION['Username'] = $username;
        $_SESSION['LoggedIn'] = 1;
      
      ?>   
        <meta http-equiv="refresh" content="2;admin.php">
      <?php
   }
    else
    {
        echo "<h1>Error</h1>";
        echo "<p>Sorry, your account could not be found. Please <a href=\"index.php\">click here to try again</a>.</p>";
    }
}
else
{
    ?>
    <div id="admin" class="content-section-a">
        <div class="container">
            <div class="row">
            
            <div class="col-md-6 col-md-offset-3 text-center wrap_title">
                <h2>Admin Login</h2>
            </div>
            
   <form method="post" action="admin.php" name="loginform" id="loginform">
   
    <input name="username" type="text" placeholder="username" class="txt" />
    <input name="password" type="password" placeholder="password" class="txt" />
    <input name="submit" type="submit" class="btn btn-embossed btn-primary view" value="submit" />
    </form>

   </div>
   </div>
   </div>
   <?php
}

?>

<footer>
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h3>Social</h3>
            <li class="social"> 
                <a href="https://www.facebook.com/cecrobothon" target="_blank"><i class="fa fa-facebook-square fa-size"> </i></a>
                <a href="https://twitter.com/cecrobothon" target="_blank"><i class="fa  fa-twitter-square fa-size"> </i> </a> 
                <a href="http://gplus.to/cecrobothon" target="_blank"><i class="fa fa-google-plus-square fa-size"> </i></a>
                <a href="#"><i class="fa fa-flickr fa-size"> </i> </a>
            </li>
            <br>
            <h3 class="footer-title">Robothon</h3>
            <p>© 2014 - 2015. Developed by the CEC WebTeam. <br> All rights reserved.</p>
            
            
           
       
          </div> <!-- /col-xs-7 -->

          <div class="col-md-5">
            <div class="footer-banner">
              <h3 class="footer-title">Robothon</h3>
              <ul>
                <li>A national level Workshop and Robo-Hack</li>
                <li>Brought to you by IEEE RAS CEC<br></li>
                <li>January 8 - 11, 2015</li><br>
                <li><a href = "http://www.cecieee.org/" target="_blank">IEEE Student Branch<br>College of Engineering Chengannur</a></li>
                <li><a href = "http://www.ceconline.edu/" target="_blank">College of Engineering Chengannur</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/owl.carousel.js"></script>
    <script src="js/script.js"></script>
    <!-- StikyMenu -->
    <script src="js/stickUp.min.js"></script>
    <script type="text/javascript">
      jQuery(function($) {
        $(document).ready( function() {
          $('.navbar-default').stickUp();
          
        });
      });
    </script>
    <!-- Smoothscroll -->
    <script type="text/javascript" src="js/jquery.corner.js"></script> 
    <script src="js/wow.min.js"></script>
    <script>
     new WOW().init();
    </script>
    <script src="js/classie.js"></script>
    <script src="js/uiMorphingButton_inflow.js"></script>
    <!-- Magnific Popup core JS file -->

</body>

</html>