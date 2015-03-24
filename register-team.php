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
if(isset($_POST["InputTeamName"]))
{ 
    $team = $_POST["InputTeamName"];
    $name = $_POST["InputName"];
    $email = $_POST["InputEmail"];
    $college = $_POST["InputCollege"];
    $year = $_POST["InputYear"];
    $branch = $_POST["InputBranch"];
    $contact = $_POST["InputContact"];
    $section = $_POST["InputSection"];
    $message = $_POST["InputMessage"];
    $member = $_POST["Memberships"];
    $attend = $_POST["Attendance"];
    $food = $_POST["Food"];
    
    $nettotal = 0; 
    if(isset($_POST["Accomodation"]))
        $accomo = $_POST["Accomodation"];
    else
        $accomo = 0;
    $atten = $_POST["Attendance"];

    if(isset($_POST["InputMessage"]))
        $message = $_POST["InputMessage"];
    else
        $message = "";
    if(isset($_POST["InputIEEENo"]))
        $IEEEnum = $_POST["InputIEEENo"];
    else
        $IEEEnum = "";
    if(isset($_POST["InputIEEENo"]))
        $IEEEno = $_POST["InputIEEENo"];
    else
        $IEEEno = "";


    $i = 0;
    foreach($accomo as $acc => $day) 
    {
            $acco[$i] = "";
            for($k = 0; $k < count($day); $k++)
            {
//                if($day[$k] === 0)
  //                  continue;
                $acco[$i] = $acco[$i] . " " . $day[$k];
                $days[$i] = count($day);
                if(count($day) == 0)
                    $days[$i] = 0;
                if($day[$k] === "0")
                {
                    $days[$i] = 0;
                    continue;
                }
            }
            $i++;            
    }
    $i = 0;
    foreach($attend as $atte => $attending)
    {
        $attends[$i] = " ";
        $rasm[$i] = 0;
        $roboatt[$i] = 0;
        for($k = 0; $k < count($attending); $k++)
        {
            $attends[$i] = $attends[$i] . "  " . $attending[$k];
            if($attending[$k] == "AIRVM")
                $rasm[$i] = 1;
            else if($attending[$k] == "Robo")
                $roboatt[$i] = 1;
        }
        $i++;
    }


    for($j=0; $j<4; $j++)
    {
   
    $totalPay = 0;
    if($roboatt[$j] == 1)
    {
    if($member[$j] == "IEEE")
        $totalPay = $totalPay + 2900;
    else if($member[$j] == "RAS")
        $totalPay = $totalPay + 2500;
    else if($member[$j] == "Non-IEEE")
        $totalPay = $totalPay + 3500;
    }

    $totalPay = $totalPay + $days[$j]*100 + $rasm[$j]*300;
 
    
    if(mysqli_query($link, "INSERT INTO registered (TeamName, Name, EmailAddress, College, Year, Branch, Phone, Section, Member, IEEENo, Attendance, Accomodation, Food, Message, TotalAmount)
           VALUES ('$team', '$name[$j]', '$email[$j]', '$college[$j]', '$year[$j]', '$branch[$j]', '$contact[$j]', '$section[$j]', '$member[$j]', '$IEEEnum[$j]', '$attends[$j]', '$acco[$j]', '$food[$j]', '$message[$j]', '$totalPay')"))
    {
        $nettotal = $nettotal + $totalPay;
    }
    else{
        ?><script> alert("failure"); </script> <?php 
    }

  }  

    ?><script>
          var pay = <?php echo json_encode($nettotal); ?>; 
          bootbox.dialog({
           message: "Your team has successfully registered for Robothon.\r\n You will have to pay a total of: " + pay + "\r\n Please check your email for further instructions",
           title: "Success!",
           buttons: {
              main: {
              label: "OK",
              className: "btn-success"    }
            }
         }); 
</script> <?php echo '<meta http-equiv="refresh" content="5;index.html">';   
} 
else
{

?>
<div id="register" class="content-section-a">
        <div class="container">
            <div class="row">
            
            <div class="col-md-6 col-md-offset-3 text-center wrap_title">
                <h2>Register</h2>
                <p class="lead" style="margin-top:0">Book your tickets for Robothon.</p>
            </div>
<div class="col-md-12  text-center">
        <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade in active" id="indiv">
            <h3>Team Registration</h3>

            <div class="col-md-12 col-md-offset-3 text-center">
            <form role="form" action="register-team.php" method="post" >
                <div class="col-md-6" >
                    <br>
                    <div class="form-group">
                        <!--label for="InputName">Your Name</label-->
                        <div class="input-group">
                            <input type="text" class="form-control" name="InputTeamName" id="InputTeamName" placeholder="Enter your team name" required>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span>
                        </div>
                    </div>
                    
        <?php for($i=1; $i<5; $i++) {
            echo '  <h4>Details of Team member '.$i.'</h4>
                    <div class="form-group">
                        <!--label for="InputName">Your Name</label-->
                        <div class="input-group">
                            <input type="text" class="form-control" name="InputName[]" id="InputName" placeholder="Enter your name" required>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <!--label for="InputEmail">Your Email</label-->
                        <div class="input-group">
                            <input type="email" class="form-control" id="InputEmail" name="InputEmail[]" placeholder="Enter your email address for us to correspond with you." required  >
                            <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <!--label for="InputCollege">Your College</label -->
                        <div class="input-group">
                            <input type="text" class="form-control" id="InputCollege" name="InputCollege[]" placeholder="Enter your college" required  >
                            <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <!--label for="InputCollege">Your College</label -->
                        <div class="input-group">
                            <input type="text" class="form-control" id="InputYear" name="InputYear[]" placeholder="Enter your year of study" required  >
                            <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <!--label for="InputCollege">Your College</label -->
                        <div class="input-group">
                            <input type="text" class="form-control" id="InputBranch" name="InputBranch[]" placeholder="Enter your branch of study" required  >
                            <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <!--label for="InputCollege">Your College</label -->
                        <div class="input-group">
                            <input type="text" class="form-control" id="InputContact" name="InputContact[]" placeholder="Enter your contact number" required  >
                            <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span>
                        </div>
                    </div>


                    <div class="form-group">
                        <!--label for="InputCollege">Your College</label -->
                        <div class="input-group">
                            <input type="text" class="form-control" id="InputSection" name="InputSection[]" placeholder="Enter your section (in case of non-IEEE members, your state)" required  >
                            <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span>
                        </div>
                    </div>

                <div class="form-group">
                        <label for="InputMemberships">Your Memberships:</label>
                        <div >
                            <select name = "Memberships[]" id="Memberships" >
                                <option value="" disabled selected style="display:none;">Select Option</option>
                                <option id="Non-IEEE" value="Non-IEEE" onclick="selected(this.value)">Non-IEEE</option>
                                <option id ="IEEE" value="IEEE"onclick="selected(this.value)">IEEE</option>
                                <option id = "RAS" value="RAS" onclick="selected(this.value)">RAS</option>
                            </select>
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <!--label for="InputCollege">Your College</label -->
                        <div class="input-group">
                            <input type="text" class="form-control" id="InputIEEENo" name="InputIEEENo[]" placeholder="Enter your IEEE Number (if you are an IEEE/RAS member)"  >
                            <span id = "IEEEspa" class="input-group-addon"><i id = "IEEEico" class="glyphicon glyphicon-ok form-control-feedback"></i></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="InputAttendence">You will be attending for?</label>
                        <div >
                            <input type="checkbox" id="Robo" name="Attendance['.($i-1).'][]" value="Robo" > Robothon <br>
                            <input type="checkbox" id="AIRVM" name="Attendance['.($i-1).'][]" value="AIRVM" > All India RAS Volunteers Meet <br>
                            <!--span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span-->
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="InputAccomodation">Accomodation required?</label>
                        <div >
                            <input type="checkbox" id="null" name="Accomodation['.($i-1).'][]" value="0" > Do not need accomodation <br>
                            <input type="checkbox" id="8" name="Accomodation['.($i-1).'][]" value="8" > January 8 <br>
                            <input type="checkbox" id="9" name="Accomodation['.($i-1).'][]" value="9" > January 9 <br>
                            <input type="checkbox" id="10" name="Accomodation['.($i-1).'][]" value="10" > January 10 <br>
                            <input type="checkbox" id="11" name="Accomodation['.($i-1).'][]" value="11" > January 11 <br>
                            <!--span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span-->
                        </div>
                    </div>

                     <div class="form-group">
                        <label for="InputMemberships">Your Food preference:</label>
                        <div >
                            <select name = "Food[]">
                                <option value="Veg">Vegetarian</option>
                                <option value="Non-Veg">Non-Vegetarian</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <!--label for="InputMessage">Message</label-->
                        <div class="input-group">
                            <textarea name="InputMessage[]" id="InputMessage" class="form-control" rows="5" placeholder="What do you expect from Robothon (*optional)"></textarea>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span>
                        </div>
                    </div> <br>  ';
        } ?>

                    <input type="submit" name="submit" id="submit" value="Submit" class="btn wow tada btn-embossed btn-primary pull-right">
                </div>
            </form>
            </div>
        </div>

<script>
    $('#myTab a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})
    </script>


</div>

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