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
/* Delete Algorithm -   s set of steps/tasks to accomplish a task/mission/function

    know what to delete?    get a list of content from the database and display it
    should be able to 'choose' / 'select' an item to be deleted
    delete the selected item

*/

//database work flow
    //  1. Connect to the database      PDO Connection Object
    //  2. Create your SQL command
    //  3. Prepare your Statement       PDO Prepared Statements
    //  4. Bind any parameters as needed
    //  5. Execute your SQL command/prepared statement
    //  6. Process your result-set/object

    //include an external PHP file into this file
    //  include
    //  require

    //1. 
    require 'database/dbConnect.php';    //copies the content of the dbConnect.php INTO this page       

    //2. create the SQL command
    $sql = "SELECT events_id,events_name,events_description FROM wdv341_events";     //all rows in that table

    $stmt = $conn->prepare($sql);   // -> is used instead of . for object->property or object->method
    
    //4. No parameters

    $stmt->execute();      

    $stmt->setFetchMode(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .flexContainer{
            display:flex;
        }
        .flexContainer div {
            width: 200px;
            border: thin solid black;
        }
    </style>
</head>
<body>
    <h1>Events System</h1>
    <h2>Delete/Update Events</h2>
    <p>Display a list of events</p>
    <section>
        <?php   //display the events in a table
        while($row = $stmt->fetch() ){      //$row is an associative array
            echo "<div class='flexContainer'>";
            echo "<div>" . $row["events_name"] . "</div>";
            echo "<div>" . $row["events_description"] . "</div>";
            $eventID = $row['events_id'];
            echo "<div><a href='deleteEvent.php?eventID=$eventID'><button>Delete</button></a></div>";

            //added to allow for UPDATE selection
            echo "<div><a href='updateEvent.php?eventID=$eventID'><button>Update</button></a></div>";
            echo "\r";
            echo "</div>";
        }
        ?>
            <h3>Return to <a href="signOn.php">Admin Main Menu</a></h3>
    </section>

    <!--
    <section>
        <div class="flexContainer">
        <div>Event Name</div>
        <div>Event Description</div>
        </div>
        <div class="flexContainer">
        <div>Event Name</div>
        <div>Event Description</div>
        </div>
    </section>
    -->
</body>
</html>