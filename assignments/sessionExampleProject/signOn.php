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
        echo "<h1>Form has Been Submitted</h1>";
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
            //process the database
            //database work flow
            //  1. Connect to the database      PDO Connection Object
            //  2. Create your SQL command
            //  3. Prepare your Statement       PDO Prepared Statements
            //  4. Bind any parameters as needed
            //  5. Execute your SQL command/prepared statement
            //  6. Process your result-set/object
            //START HERE on Thursday
            require 'database/dbConnect.php';

            //$sql = "SELECT event_user_name, event_user_password from wdv341_event_users WHERE event_user_name = :userName";
            $sql = "SELECT COUNT(*) from wdv341_event_users WHERE event_user_name = :userName AND event_user_password = :userPassword";

            $stmt = $conn->prepare($sql);   

            $stmt->bindParam(':userName', $inUsername);
            $stmt->bindParam(':userPassword', $inPassword);

            $stmt->execute();

            //How do I know whether or not I found a matching username/password in the database?
            $numberOfRows = $stmt->fetchColumn();       //get the number of rows from the result
            echo "<h1>$numberOfRows</h1>";
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
    <title>Document</title>
</head>
<body>
    <h1>Login to the Session Example Project</h1>
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
        <h2>Event ADMIN System</h2>
            <ol>Admin Functions
                <li><a href="inputEvent.php">Add Event</a></li>
                <li><a href="showEvents.php">Show All Events - Update/Delete</a></li>
                <li><a href="logout.php">Sign Out</a></li>
    </ol>
        <?php
        }   //close else branch of the ADMIN display area
        ?>
        
</body>
</html>