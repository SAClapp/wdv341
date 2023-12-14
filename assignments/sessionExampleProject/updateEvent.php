<?php
session_start();        //join an existing session, if any, otherwise start a new session
//set a session variable to restrict this page to only a valid user - must sign on to see page
if($_SESSION['validUser'] == "valid"){
    //if($_SESSION['userInputRole'] == "valid")
    //true branch - valid user, let them see the page
}
else {
    //false branch - INVALID user, return them to the login page or home page
    header("Location: signOn.php");
}
    $eventID = $_GET['eventID'];    //must match the index/name from showEvents

    //database work flow
    //  1. Connect to the database      PDO Connection Object
    //  2. Create your SQL command
    //  3. Prepare your Statement       PDO Prepared Statements
    //  4. Bind any parameters as needed
    //  5. Execute your SQL command/prepared statement
    //  6. Process your result-set/object
    require 'database/dbConnect.php';

    $sql = "SELECT * FROM wdv341_events WHERE events_id = :eventID";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':eventID', $eventID);

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $recordData = $stmt->fetch();           //associative array name=value  column Name-value in that column

    //Process results???    display the values for each field on the form


    //This file is a self posting form that will UPDATE a record in the database
    /*  Algorithm

        x   choose which record to UPDATE       - showEvents passed eventID to this page
        x   do a SELECT for the eventID to get the data for the UPDATE
        x   place the data into the form (show the user what they entered)
        x   display the filled put form to the user - 
        x   when the user SUBMITS form -
        x   validate the form fields
        if validDATA
            UPDATE record in database
        else
            show error messages
            display the form back to the user

    */

    $confirmMessage = false;    //make this variable available to the whole page

    $eventNameMsg = "";     //define a global variable with no content
    $eventDescMsg = "";
    $eventPresenterMsg = "";
    $eventDateMsg = "";
    $eventTimeMsg = "";

    $eventDishMsg = "";

    //default value to display on the form the first time it is requested
    //Can I assign my SELECT data into these variables to be displayed on the form
    //$inEventName = "";
    $inEventName = $recordData['events_name'];

    $inEventDesc = $recordData['events_description'];
    $inEventPresenter = $recordData['events_presenter'];
    $inEventDate = $recordData['events_date'];
    $inEventTime = $recordData['events_time'];

    $inEventDish = "";

    if(isset($_POST['submit'])){

        //process form data into PHP variables
        $inEventName = $_POST['events_name']; //get the data from the form fields
        $inEventDesc = $_POST['events_description'];
        $inEventPresenter = $_POST['events_presenter'];
        $inEventDate = $_POST['events_date'];
        $inEventTime = $_POST['events_time'];

        function validateHoneyPot($inDish){
            if($_POST["events_dish"] != ""){
                global $validInput, $eventDishMsg;
                $validInput = false;
                $eventDishMsg = "INVALID DATA!";
            }
        }

        function validateEventName($inName){
            if($inName == ""){
                //invalid
                //$validInput = false
                //display error message 
                global $validInput, $eventNameMsg;
                $validInput = false;
                $eventNameMsg = "Enter Event Name";
            }
        }

        function validateEventDesc($inDesc){
            if($inDesc == ""){
                //invalid
                //$validInput = false
                //display error message 
                global $validInput, $eventDescMsg;
                $validInput = false;
                $eventDescMsg = "Enter Event Description";
            }
        }

        function validateEventPresenter($inPresenter){
            if($inPresenter == ""){
                //invalid
                //$validInput = false
                //display error message 
                global $validInput, $eventPresenterMsg;
                $validInput = false;
                $eventPresenterMsg = "Enter Event Presenter";
            }
        }

        function validateEventDate($inDate){
            if($inDate == ""){
                //invalid
                //$validInput = false
                //display error message 
                global $validInput, $eventDateMsg;
                $validInput = false;
                $eventDateMsg = "Enter Event Date";
            }
        }

        function validateEventTime($inTime){
            if($inTime == ""){
                //invalid
                //$validInput = false
                //display error message 
                global $validInput, $eventTimeMsg;
                $validInput = false;
                $eventTimeMsg = "Enter Event Time";
            }
        }

        //validate input data
        /*
            assume all the input is valid $validInput - true
            validate input data field by field
            validation function - validateEventName()
                if input invalid
                $validInput = false
                display error message - who fixes the date?
            validation function
            validation function...

            if($validInput){
                //all input id good
                process data into the database    
            }
            else{
                send this back to the user/customer to fix - show form to customer
                they will resubmit the form
            }
        */
        /* TDD Test Driven Development
            plan all of your inputs/expectation BEFORE you write the code

            input       expected output
            "WDV341"    valid
            "Study..."  valid
            ""          invalid
            123         invalid
            "Fredd"     valid - ???
            &**(&)      invalid

        */
    $validInput = true;

    validateEventName($inEventName);
    validateEventDesc($inEventDesc);
    validateEventPresenter($inEventPresenter);
    validateEventDate($inEventDate);
    validateEventTime($inEventTime);
    validateHoneyPot($inEventDish);
    //call as many validations as we need
    
    if($validInput){
        //process into database

        //create our SQL Command and INSERT into database
        //update the database

        //connect to the database
        require 'database/dbConnect.php';

        //build mySQL command - CHANGE this to UPDATE SQL
        //$sql = "INSERT INTO wdv341_events";
        //$sql .= "(events_name, events_description, events_presenter, events_date, events_time, events_date_entered, events_date_updated)";
        //$sql .= " VALUES ";
        //$sql .= "(:eventName, :eventDesc, :eventPresenter, :eventDate, :eventTime, :eventDateEntered, :eventDateUpdated)";

        $sql = "UPDATE wdv341_events SET events_name = :eventName,";
        $sql .= "events_description = :eventDesc,";
        $sql .= "events_presenter = :eventPresenter,";
        $sql .= "events_date = :eventDate,";
        $sql .= "events_time = :eventTime,";
        $sql .= "events_date_updated = :eventDateUpdated";
        $sql .= " WHERE events_id = :eventID";

        

        //prepare statement
        $stmt = $conn->prepare($sql);

        //bind parameters

        $today = date("Y-m-d");

        $stmt->bindParam(':eventName', $inEventName);
        $stmt->bindParam(':eventDesc', $inEventDesc);
        $stmt->bindParam(':eventPresenter', $inEventPresenter);
        $stmt->bindParam(':eventDate', $inEventDate);
        $stmt->bindParam(':eventTime', $inEventTime);
        //$stmt->bindParam(':eventDateEntered', $today);
        $stmt->bindParam(':eventDateUpdated', $today);
        $stmt->bindParam(':eventID', $eventID);

        //execute SQL Command
        $stmt->execute();

        //display confirmation message - display the HTML
        $confirmMessage = true;     //this is set once all the data is in the database
    }
        else{
            //send form back to user
        }
    }
    //form has been submitted branch

        

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>

        .confirmMessage {
            width:500px;
            background-color: green;
            margin-left:auto;
            margin-right:auto;
        }

        .errMsg {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Update Event Information</h1>
<?php
        /*
            if we have updated the database
                then we will display the confirmation message
            else
                display the form
        */
        if($confirmMessage){
?>
    <div class="confirmMessage">
        <h2>Thank you very much. We have input your information.</h2>
        <h3>Return to <a href="signOn.php">Admin Main Menu</a></h3>
        <p>Return To <a href="showEvents.php">List of Events</a></p>
    </div>
<?php
        }
        else{
?>
    <form method="post" action="updateEvent.php?eventID=<?php echo $eventID; ?>">

        <p>
        <label for="events_name">Event Name:</label>
        <input type="text" name="events_name" id="events_name" value="<?php echo $inEventName; ?>">
        <span class="errMsg"><?php echo $eventNameMsg; ?></span>
        </p>

        <p>
            <label for="events_description">Event Description: </label>
            <input type="text" name="events_description" id="events_description" value="<?php echo $inEventDesc; ?>">
            <span class="errMsg"><?php echo $eventDescMsg; ?></span>
        </p>

        <p>
            <label for="events_presenter">Event Presenter: </label>
            <input type="text" name="events_presenter" id="events_presenter" value="<?php echo $inEventPresenter; ?>">
            <span class="errMsg"><?php echo $eventPresenterMsg; ?></span>
        </p>

        <p>
            <label for="events_date">Event Date: <label>
            <input type="date" name="events_date" id="events_date" value="<?php echo $inEventDate; ?>">
            <span class="errMsg"><?php echo $eventDateMsg; ?></span>
        </p>

        <p>
            <label for="events_time">Event time: <label>
            <input type="time" name="events_time" id="events_time" value="<?php echo $inEventTime; ?>">
            <span class="errMsg"><?php echo $eventTimeMsg; ?></span>
        </p>

        <p>
            <label for="events_dish">Event Dish:</label>
            <input type="text" name="events_dish" id="events_dish" value="<?php echo $inEventDish; ?>">
            <span class="errMsg"><?php echo $eventDishMsg; ?></span>
        </p>

        <p>
        <input type="submit" name="submit" value="Submit">
        <input type="reset">
        </p>
    </form>
    <h3>Return to <a href="signOn.php">Admin Main Menu</a></h3>
    <p>Return To <a href="showEvents.php">List of Events</a></p>
    <?php
    }
    ?>
</body>
</html>