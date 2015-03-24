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

    <script>                         
            function checknow(theForm) {
                var checkcheckboxes = document.getElementByName(Attendance);
                for(var i=0; i<checkcheckboxes.length; i++)
                    {
                        if(checkcheckboxes[i].checked)
                            return true;
                    }
                alert("Select one event");
                return false;
            }

    </script>
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

if(isset($_POST["InputName"]))
{
    
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
    $days = 0; 
    $rasm = 0;
    $roboatt = 0;
    $attends = "";
    $acco = "";
    if(isset($_POST["Accomodation"]))
    {
        foreach($_POST["Accomodation"] as $day) {
            $days++;
            $acco = $acco . "  " . $day;
        }

    }
    foreach($_POST["Attendance"] as $attending)
    {
        $attends = $attends . "  " . $attending;
        if($attending == "AIRVM")
            $rasm = 1;
        else if($attending == "Robo")
            $roboatt = 1;
    }
    if(isset($_POST["InputMessage"]))
        $message = $_POST["InputMessage"];
    else
        $message = "";
    if(isset($_POST["InputIEEENo"]))
        $IEEEnum = $_POST["InputIEEENo"];
    else
        $IEEEnum = "";
    

    
    $food = $_POST["Food"];
    $IEEEno = $_POST["InputIEEENo"];

    $totalPay = 0;
    if($roboatt == 1)
    {
    if($member == "IEEE")
        $totalPay = $totalPay + 2900;
    else if($member == "RAS")
        $totalPay = $totalPay + 2500;
    else if($member == "Non-IEEE")
        $totalPay = $totalPay + 3500;
    }

    $totalPay = $totalPay + $days*100 + $rasm*300;
//    echo $totalPay;


    if(mysqli_query($link, "INSERT INTO registered (TeamName, Name, EmailAddress, College, Year, Branch, Phone, Section, Member, IEEENo, Attendance, Accomodation, Food, Message, TotalAmount)
           VALUES ('Individual', '$name', '$email', '$college', '$year', '$branch', '$contact', '$section', '$member', '$IEEEnum', '$attends', '$acco', '$food', '$message', '$totalPay')"))
    {

        ?><script>
          var pay = <?php echo json_encode($totalPay); ?>; 
          alert("Success! You will have to pay a total of: " +pay+". \r\n Please check you email for further instructions.");/*
          bootbox.dialog({
           message: "You have successfully registered for Robothon.\n You will have to pay a total of: " + pay + ".\n Please check your email for further instructions",
           title: "Success!",
           buttons: {
              main: {
              label: "OK",
              className: "btn-success"    }
            }
         }); */
</script><?php echo '<meta http-equiv="refresh" content="5;index.html">';   
    }
    else{
        ?><script> alert("failure"); </script> <?php 
    }
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
            <h3>Individual Registration</h3>

            <div class="col-md-12 col-md-offset-3 text-center">
            <form role="form" action="register-individual.php" onsubmit="return checknow(this);" method="post" >
                <div class="col-md-6" >
                    <br>
                    <div class="form-group">
                        <!--label for="InputName">Your Name</label-->
                        <div class="input-group">
                            <input type="text" class="form-control" name="InputName" id="InputName" placeholder="Enter your name" required>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <!--label for="InputEmail">Your Email</label-->
                        <div class="input-group">
                            <input type="email" class="form-control" id="InputEmail" name="InputEmail" placeholder="Enter your email address for us to correspond with you." required  >
                            <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <!--label for="InputCollege">Your College</label -->
                        <div class="input-group">
                            <input type="text" class="form-control" id="InputCollege" name="InputCollege" placeholder="Enter your college" required  >
                            <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <!--label for="InputCollege">Your College</label -->
                        <div class="input-group">
                            <input type="text" class="form-control" id="InputYear" name="InputYear" placeholder="Enter your year of study" required  >
                            <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <!--label for="InputCollege">Your College</label -->
                        <div class="input-group">
                            <input type="text" class="form-control" id="InputBranch" name="InputBranch" placeholder="Enter your branch of study" required  >
                            <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <!--label for="InputCollege">Your College</label -->
                        <div class="input-group">
                            <input type="text" class="form-control" id="InputContact" name="InputContact" placeholder="Enter your contact number" required  >
                            <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span>
                        </div>
                    </div>


                    <div class="form-group">
                        <!--label for="InputCollege">Your College</label -->
                        <div class="input-group">
                            <input type="text" class="form-control" id="InputSection" name="InputSection" placeholder="Enter your section (in case of non-IEEE members, your state)" required  >
                            <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span>
                        </div>
                    </div>

                    <!--div class="form-group">
                        <label for="InputMemberships">Your Memberships:</label>
                        <div >
                            <input type="radio" id="IEEE" name="Memberships" value="IEEE" required > IEEE Member <br>
                            <input type="radio" id="RAS" name="Memberships" value="RAS" > IEEE RAS Member <br>
                            <input type="radio" id="Non-IEEE" name="Memberships"  value="Non-IEEE"> Non-IEEE Member <br>                            
                           
                        </div>
                    </div-->

                     <div class="form-group">
                        <label for="InputMemberships">Your Memberships:</label>
                        <div >
                            <select name = "Memberships" id="Memberships" onchange="selected(this.value)" >
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
                            <input type="text" class="form-control" id="InputIEEENo" name="InputIEEENo" placeholder="Enter your IEEE Number"  >
                            <span id = "IEEEspa" class="input-group-addon"><i id = "IEEEico" class="glyphicon glyphicon-ok form-control-feedback"></i></span>
                        </div>
                    </div>

                    <script>

                    function selected(sel_value)
                    {
                        if(sel_value === "IEEE" || sel_value === "RAS" )
                        {
                            $('#InputIEEENo').show();                                
                            $('#IEEEico').show();
                            $('#IEEEspa').show();                            
                        }
                        else
                        {
                            $('#InputIEEENo').hide(); 
                            $('#IEEEico').hide();
                            $('#IEEEspa').hide();                            
                        }
                    } 
                        $('#InputIEEENo').hide(); 
                        $('#IEEEico').hide();
                        $('#IEEEspa').hide(); /*

                        $('#Memberships').change(function() {
                        {
                            if($(this).val() == "IEEE")
                                alert("kandupidichu");
                            else
                                alert("kittiyilla");
                        }
                        });
                        /*
                        $('#IEEE').change(function() {
                            if(this.checked) {
                            $('#InputIEEENo').show();                                
                            $('#IEEEico').show();
                            $('#IEEEspa').show();
                            }
                        });
                        $('#RAS').change(function() {
                            if(this.checked) {
                                $('#InputIEEENo').show();                                
                                $('#IEEEico').show();
                                $('#IEEEspa').show();
                                }
                        });
                        $('#Non-IEEE').change(function() {
                            if(this.checked) {
                                $('#InputIEEENo').hide();                                
                                $('#IEEEico').hide();
                                $('#IEEEspa').hide();
                                }
                        }); */

                                               
                    </script>

                    <div class="form-group">
                        <label for="InputAttendence">You will be attending for?</label>
                        <div >
                            <input type="checkbox" id="Robo" name="Attendance[]" value="Robo" > Robothon <br>
                            <input type="checkbox" id="AIRVM" name="Attendance[]" value="AIRVM" > All India RAS Volunteers Meet <br>
                            <!--span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span-->
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="InputAccomodation">Accomodation required?</label>
                        <div >
                            <input type="checkbox" id="8" name="Accomodation[]" value="8" > January 8 <br>
                            <input type="checkbox" id="9" name="Accomodation[]" value="9" > January 9 <br>
                            <input type="checkbox" id="10" name="Accomodation[]" value="10" > January 10 <br>
                            <input type="checkbox" id="11" name="Accomodation[]" value="11" > January 11 <br>
                            <!--span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span-->
                        </div>
                    </div>

                    <!--div class="form-group">
                        <label for="InputMemberships">Your Food preference:</label>
                        <div >
                            <input type="radio" id="Veg" name="Food" value="Veg" required > Vegeterian <br>
                            <input type="radio" id="Non-Veg" name="Food" value="Non-Veg" > Non-Vegeterian <br>
                        </div>
                    </div-->

                     <div class="form-group">
                        <label for="InputMemberships">Your Food preference:</label>
                        <div >
                            <select name = "Food">
                                <option value="Veg">Vegetarian</option>
                                <option value="Non-Veg">Non-Vegetarian</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <!--label for="InputMessage">Message</label-->
                        <div class="input-group">
                            <textarea name="InputMessage" id="InputMessage" class="form-control" rows="5" placeholder="What do you expect from Robothon (*optional)"></textarea>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span>
                        </div>
                    </div>

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