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

    echo "<h1>$eventID</h1>";

    require 'database/dbConnect.php'; 

    //$sql = "SELECT events_name,events_description FROM wdv341_events";     
    $sql = "DELETE FROM wdv341_events WHERE events_id = :eventID ";

    $stmt = $conn->prepare($sql);   // -> is used instead of . for object->property or object->method
    
    //4. Bind Parameters
    $stmt->bindParam(':eventID',$eventID);

    $stmt->execute();      

    $stmt->setFetchMode(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Events System</h1>
    <h2>Event Delete</h2>
    <p>Your event has been deleted. <a href="showEvents.php">Please return to the Admin System.</a></p>
</body>
</html>