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
    require '../database/dbConnect.php';

    //2. create the SQL command
    $sql = "SELECT item_id,item_name,item_desc FROM menu_items_table";     //all rows in that table

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" 
integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<link rel="stylesheet" href="admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&family=Permanent+Marker&display=swap" rel="stylesheet">
    <title>Modify/Delete Item</title>
    <style>
        .flexContainer{
            display:flex;
            justify-content: center;
        }
        .flexContainer div {
            width: 200px;
            border: thin solid black;
            padding: 10px;
        }
    </style>
</head>
<body>
<header>
            <div class="mt-4 p-5 ">
              <img class="img-fluid " src="../images/banner.jpg" alt="Savanna's Coffee House Logo" width="auto" height="auto"><br><br>
              <h1>Modify/Delete Menu Item</h1>
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
    <section>
        <h2>Modify/Delete Item</h2>
        <?php   
        while($row = $stmt->fetch() ){      //$row is an associative array
            echo "<div class='flexContainer'>";
            echo "<div>" . $row["item_name"] . "</div>";
            echo "<div id='desc'>" . $row["item_desc"] . "</div>";
            $itemID = $row['item_id'];
            echo "<div><a href='deleteItem.php?itemID=$itemID'><button>Delete</button></a></div>";

            //added to allow for UPDATE selection
            echo "<div><a href='updateItem.php?itemID=$itemID'><button>Update</button></a></div>";
            echo "\r";
            echo "</div>";
        }
        ?>
        </section>
            <h3>Return to <a href="signOn.php">Admin Main Menu</a></h3>
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