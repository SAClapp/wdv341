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
    $itemID = $_GET['itemID'];    //must match the index/name from showEvents

    //database work flow
    //  1. Connect to the database      PDO Connection Object
    //  2. Create your SQL command
    //  3. Prepare your Statement       PDO Prepared Statements
    //  4. Bind any parameters as needed
    //  5. Execute your SQL command/prepared statement
    //  6. Process your result-set/object
    require '../database/dbConnect.php';

    $sql = "SELECT * FROM menu_items_table WHERE item_id = :itemID";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':itemID', $itemID);

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $recordData = $stmt->fetch();           //associative array name=value  column Name-value in that column


    $confirmMessage = false;    //make this variable available to the whole page

    $itemNameMsg = "";     //define a global variable with no content
    $itemDescMsg = "";
    $itemPriceMsg = "";
    $itemDateAddMsg = "";
    $itemTypeMsg = "";

    $sideDishMsg = "";

    //default value to display on the form the first time it is requested
    //Can I assign my SELECT data into these variables to be displayed on the form

    $inItemName = $recordData['item_name'];
    $inItemDesc = $recordData['item_desc'];
    $inItemPrice = $recordData['item_price'];
    $inItemDateAdd = $recordData['item_date_added'];
    $inItemType = $recordData['item_type'];

    $inSideDish = "";

    if(isset($_POST['submit'])){

        //process form data into PHP variables
        $inItemName = $_POST['item_name']; //get the data from the form fields
        $inItemDesc = $_POST['item_desc'];
        $inItemPrice = $_POST['item_price'];
        $inItemDateAdd = $_POST['item_date_added'];
        $inItemType = $_POST['item_type'];

        function validateHoneyPot($inSDish){
            if($_POST["side_dish"] != ""){
                global $validInput, $sideDishMsg;
                $validInput = false;
                $sideDishMsg = "INVALID DATA!";
            }
        }

        function validateItemName($inName){
            if($inName == ""){
                //invalid
                //$validInput = false
                //display error message 
                global $validInput, $itemNameMsg;
                $validInput = false;
                $itemNameMsg = "Enter Item Name";
            }
        }

        function validateItemDesc($inDesc){
            if($inDesc == ""){
                //invalid
                //$validInput = false
                //display error message 
                global $validInput, $itemDescMsg;
                $validInput = false;
                $itemDescMsg = "Enter Item Description";
            }
        }

        function validateItemPrice($inPrice){
            if($inPrice == ""){
                //invalid
                //$validInput = false
                //display error message 
                global $validInput, $itemPriceMsg;
                $validInput = false;
                $itemPriceMsg = "Enter Item Price";
            }
        }

        function validateItemDateAdded($inDateAdd){
            if($inDateAdd == ""){
                //invalid
                //$validInput = false
                //display error message 
                global $validInput, $itemDateAddMsg;
                $validInput = false;
                $itemDateAddMsg = "Enter Item Date of Entry";
            }
        }

        function validateItemType($inType){
            if($inType == ""){
                //invalid
                //$validInput = false
                //display error message 
                global $validInput, $itemTypeMsg;
                $validInput = false;
                $itemTypeMsg = "Enter Item Type";
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

    $validInput = true;

    validateItemName($inItemName);
    validateItemDesc($inItemDesc);
    validateItemPrice($inItemPrice);
    validateItemDateAdded($inItemDateAdd);
    validateItemType($inItemType);
    validateHoneyPot($inSideDish);
    //call as many validations as we need
    
    if($validInput){
        //process into database

        //create our SQL Command and INSERT into database
        //update the database

        //connect to the database
        require '../database/dbConnect.php';

        //build mySQL command - CHANGE this to UPDATE SQL

        $sql = "UPDATE menu_items_table SET item_name = :itemName,";
        $sql .= "item_desc = :itemDesc,";
        $sql .= "item_price = :itemPrice,";
        $sql .= "item_date_added = :itemDateAdd,";
        $sql .= "item_type = :itemType,";
        $sql .= "item_date_updated = :itemDateUpdated";
        $sql .= " WHERE item_id = :itemID";

        

        //prepare statement
        $stmt = $conn->prepare($sql);

        //bind parameters

        $today = date("Y-m-d");

        $stmt->bindParam(':itemName', $inItemName);
        $stmt->bindParam(':itemDesc', $inItemDesc);
        $stmt->bindParam(':itemPrice', $inItemPrice);
        $stmt->bindParam(':itemDateAdd', $inItemDateAdd);
        $stmt->bindParam(':itemType', $inItemType);
        $stmt->bindParam(':itemDateUpdated', $today);
        $stmt->bindParam(':itemID', $itemID);

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
    <title>Update Menu Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" 
integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<link rel="stylesheet" href="admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&family=Permanent+Marker&display=swap" rel="stylesheet">
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
<header>
            <div class="mt-4 p-5 ">
              <img class="img-fluid " src="../images/banner.jpg" alt="Savanna's Coffee House Logo" width="auto" height="auto"><br><br>
              <h1>Update Menu Item</h1>
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
        <p>Return To <a href="showItems.php">List of Menu Items</a></p>
    </div>
<?php
        }
        else{
?>
    <form method="post" action="updateItem.php?itemID=<?php echo $itemID; ?>">

        <p>
        <label for="item_name">Item Name:</label>
        <input type="text" name="item_name" id="item_name" value="<?php echo $inItemName; ?>">
        <span class="errMsg"><?php echo $itemNameMsg; ?></span>
        </p>

        <p>
            <label for="item_desc">Item Description: </label>
            <input type="text" name="item_desc" id="item_desc" value="<?php echo $inItemDesc; ?>">
            <span class="errMsg"><?php echo $itemDescMsg; ?></span>
        </p>

        <p>
            <label for="item_price">Item Price: </label>
            <input type="text" name="item_price" id="item_price" value="<?php echo $inItemPrice; ?>">
            <span class="errMsg"><?php echo $itemPriceMsg; ?></span>
        </p>

        <p>
            <label for="item_type">Item Type: <label>
            <input type="text" name="item_type" id="item_type" value="<?php echo $inItemType; ?>">
            <span class="errMsg"><?php echo $itemTypeMsg; ?></span>
        </p>

        <p>
            <label for="item_date_added">Date Added: <label>
            <input type="date" name="item_date_added" id="item_date_added" value="<?php echo $inItemDateAdd; ?>">
            <span class="errMsg"><?php echo $itemDateAddMsg; ?></span>
        </p>

        <p>
            <label for="side_dish">Side Dish:</label>
            <input type="text" name="side_dish" id="side_dish" value="<?php echo $inSideDish; ?>">
            <span class="errMsg"><?php echo $sideDishMsg; ?></span>
        </p>

        <p>
        <input type="submit" name="submit" value="Submit">
        <input type="reset">
        </p>
    </form>
    <h3>Return to <a href="signOn.php">Admin Main Menu</a></h3>
    <p>Return To <a href="showItems.php">List of Menu Items</a></p>
    <?php
    }
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