<?php
//1.
require '../database/dbConnectHost.php';    

//2. create the SQL command
$sql = "SELECT events_name,events_description,events_presenter,events_date,events_time FROM wdv341_events WHERE events_id=:recId";     

//3. prepare out statement object PDO Prepared Statements
$stmt = $conn->prepare($sql);  

//4. Bind parameters - named parameter          uses ? as a parameter, s and i
$recID = 4;
$stmt->bindParam(':recId', $recID);

//5. Execute the statement
$stmt->execute(); 

//6. 
$stmt->setFetchMode(PDO::FETCH_ASSOC);  


include 'Events/Events.php';

//create a new instance of the Events class
$outputObj = new Events();
while($row = $stmt->fetch() ){
$outputObj->set_event_name($row["events_name"]);
//echo $outputObj->get_event_name();    //test to make sure the value I expected to be assigned to event_name was assigned
$outputObj->set_event_description($row["events_description"]);
$outputObj->set_event_presenter($row["events_presenter"]);
$outputObj->set_event_date($row["events_date"]);
$outputObj->set_event_time($row["events_time"]);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>9-1: PHP-JSON Event Object</title>
</head>
<body>
    <h1>WDV341 Intro PHP</h1>
    <h2>9-1: PHP-JSON Event Object</h2>
    <br>
    <h3>$outputObj:</h3>
    <?php
    
    echo json_encode($outputObj);

    ?>
</body>
</html>