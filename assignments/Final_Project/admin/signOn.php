<?php
session_start();        //join an existing session, if any, otherwise start a new session
/* Algorithm for a sign on page

provide a signon form - username and password, self posting

if(validUser){
    show Admin page
}
else{
    show login page
}
if(form has been submitted)
{
    x process form data
    x validate input data
        if error 
            displayForm
            validData = false       //bad data switch on!
    if(validData)
        access database
            (SQL SELECT WHERE clause username/password )
        if you find the username/password in the database
            -you are valid user
            -display Admin Page/content
            -set Session variables to maintain the state-keep you signed on, have access to pages
        else
            -Invalid username/password - ERROR
            display login form OR return to home page
    else
        ERROR - Invalid username or password
        x display login form 
}
else{
    x display the form
}
//VIEW - HTML area

if(validUser - signed on){
    display the admin content
}
else{
    display the login form
}

*/

if(isset($_SESSION['validUser']) && $_SESSION['validUser'] == "valid"){
    //show Admin page
    $displayForm = false;       //display form (true) or Admin Page (false)
}
else{
    $inUsername = "";
    $inPassword = "";
    $usernameErrMsg = "";
    $passwordErrMsg = "";
    $signOnErrMsg = "";


    if( isset($_POST['submit'])){
        $displayForm = false;

        $inUsername = $_POST['username'];
        $inPassword = $_POST['password'];

        //validate input values

        $validData = true;          //assume the input data is good
        if($inUsername == ""){
            //display error message on the form
            $usernameErrMsg = "Please enter a username";
            $validData = false;
            //put the input values back into the form fields
            //display the form
        }

        if($inPassword == ""){
            //display error message on the form
            $passwordErrMsg = "Please enter a password";
            $validData = false;
            //put the input values back into the form fields
            //display the form
        }

        if($validData){

            require '../database/dbConnect.php';

            //$sql = "SELECT event_user_name, event_user_password from wdv341_event_users WHERE event_user_name = :userName";
            $sql = "SELECT COUNT(*) from wdv341_event_users WHERE event_user_name = :userName AND event_user_password = :userPassword";

            $stmt = $conn->prepare($sql);   

            $stmt->bindParam(':userName', $inUsername);
            $stmt->bindParam(':userPassword', $inPassword);

            $stmt->execute();

            //How do I know whether or not I found a matching username/password in the database?
            $numberOfRows = $stmt->fetchColumn();       //get the number of rows from the result
            if($numberOfRows > 0){
                //found a valid username/password - continue processing this as a valid user
                //dispaly the Admin Page
                $displayForm = false;       //DO NOT display the form, instead display the ADMIN Page
            }
            else{
                //invalid username/password ???
                //display error messages
                $inUsername = "";
                $inPassword = "";
                $signOnErrMsg = "Invalid username or password. Please try again.";
                //display the form
                $displayForm = true;    //invalid username/password - show the form
            }
        }
        else{
            //display the form
            $displayForm = true;        //set our displayForm flag/switch to true 
        }
    }
    else{
        //echo "<h1>Display Login Form</h1>";
        $displayForm = true;
    }
}//end the validUser if statment
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" 
integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<link rel="stylesheet" href="admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&family=Permanent+Marker&display=swap" rel="stylesheet">
    <title>Sign in to Admin</title>
</head>
<body>
<header>
            <div class="mt-4 p-5 ">
              <img class="img-fluid " src="../images/banner.jpg" alt="Savanna's Coffee House Logo" width="auto" height="auto"><br><br>
              <h1>Savanna's Coffee House Admin Main Menu</h1>
            </div>
          </header>
        <nav class="navbar navbar-expand-sm">
            <div class="container-fluid">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link btn btn-light text-danger" href="../index.php">Home</a>
                </li>
                <div class="space"></div><!--for space between buttons-->
               <li class="nav-item">
                  <a class="nav-link btn btn-light text-danger" href="../about.php">About Us</a>
                </li>
                <div class="space"></div><!--for space between buttons-->
                <li class="nav-item">
                    <a class="nav-link btn btn-light text-danger" href="../menu.php">Menu</a>
                  </li>
                  <div class="space"></div><!--for space between buttons-->
                  <li class="nav-item">
                    <a class="nav-link btn btn-light text-danger" href="../events.php">Events</a>
                  </li>
                  <div class="space"></div><!--for space between buttons-->
                <li class="nav-item">
                  <a class="nav-link btn btn-light text-danger" href="../contact.php">Contact Us!</a>
                  </li>
                  <div class="space"></div><!--for space between buttons-->
                <li class="nav-item">
                  <a class="nav-link btn btn-light text-danger" href="signOn.php">Admin</a>
                  </li>
                  <div class="space"></div><!--for space between buttons-->
              </ul>
            </div>
            </nav>
            <main>
            <div class="container">
            <div class="row">
              <div class="col" style="background-color:#aaa;">
    <?php
        if($displayForm){
            //the user has SIGNED ON and should display the Admin System
            //echo "<h2>Display Form</h2>";
    ?>
            <form method="post" action="signOn.php">

            <div style="color:red;">
            <?php echo $signOnErrMsg; ?>
        </div>

            <p>
                <label for="username">Username: </label>
                <input type="text" name="username" id="username"  value="<?php echo $inUsername; ?>">
                <span><?php echo $usernameErrMsg; ?></span>
        </p>
        <p>
                <label for="password">Password: </label>
                <input type="password" name="password" id="password" value="<?php echo $inPassword; ?>">
                <span><?php echo $passwordErrMsg; ?></span>
        </p>
        <p>
                <input type="submit" name="submit" value="Submit">
                <input type="reset">
        </p>

        </form>
    <?php
        }
        else{
            //display the Admin Form - Valid User
            //set session variables for a valid user
            $_SESSION['validUser'] = "valid";   //check this on all Admin pages
            //$_SESSION['userRole'] = "admin";
            //header("Location: admin/adminMain.php");
        ?>
        <h2>Menu Item ADMIN System</h2>
            <ul>Admin Functions
                <li><a href="inputItem.php">Add Menu Item</a></li>
                <li><a href="showItems.php">Modify or Delete Menu Item(s)</a></li>
                <li><a href="logout.php">Logout</a></li>
    </ul>
        <?php
        }   //close else branch of the ADMIN display area
        ?>
            </div>
            </div>
          </div>
        </main>
                <a href="../index.php#top" class="btn btn-light text-danger back">Back to Home</a>
        <a href="#top" class="btn btn-light text-danger back">Back To Top</a>
            <footer>
              <h2>
                Savanna's Coffee House ©<?php echo date("Y");?>
              </h2>
              <h4>
                604 24th Street St. Paul, Minnesota
              </h4>
              <h4>
                Call Us: 702-971-1154
              </h4>
            </footer>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" 
  integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" 
integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>