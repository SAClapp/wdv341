<?php
    //1. 
    require 'database/dbConnect.php';    //copies the content of the dbConnect.php INTO this page       

    //2. create the SQL command
    $sql = "SELECT item_name,item_desc,item_price FROM menu_items_table WHERE item_type = 'sandwhich'"; 

    //3. prepare our statement object PDO Prepared Statements
    $stmt = $conn->prepare($sql);   
    //4. No parameters

    //5. Execute the statement
    $stmt->execute();   //runs the prepared statement, stores the results within the statement object      

    //6. 
    $stmt->setFetchMode(PDO::FETCH_ASSOC);      //setting ALL fetch commands to return associative array




?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
          Savanna's Coffee House Menu
        </title>
        <!--
            Author: Seth Clapp
            Date: December 8th, 2022
        -->
        <meta charset="utf-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" 
integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&family=Permanent+Marker&display=swap" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Savanna's Coffee House Menu">
  <meta name="keywords" content="Savanna's, Coffee, Beverages, Drinks, Menu, Sandwhiches, Soups, Desserts, Tea, Food, Sweets, 
  Bakery, Cheese, Yogurt, Cinnamon Rolls">
    </head>
    <body>
        <header>
            <div class="mt-4 p-5 ">
              <img class="img-fluid " src="images/banner.jpg" alt="Savanna's Coffee House Logo" width="auto" height="auto"><br><br>
              <h1>Menu</h1>
            </div>
          </header>
          <nav class="navbar navbar-expand-sm">
            <div class="container-fluid">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link btn btn-light text-danger" href="index.php">Home</a>
                </li>
                <div class="space"></div><!--for space between buttons-->
               <li class="nav-item">
                  <a class="nav-link btn btn-light text-danger" href="about.php">About Us</a>
                </li>
                <div class="space"></div><!--for space between buttons-->
                <li class="nav-item">
                    <a class="nav-link btn btn-light text-danger" href="menu.php">Menu</a>
                  </li>
                  <div class="space"></div><!--for space between buttons-->
                  <li class="nav-item">
                    <a class="nav-link btn btn-light text-danger" href="events.php">Events</a>
                  </li>
                  <div class="space"></div><!--for space between buttons-->
                <li class="nav-item">
                  <a class="nav-link btn btn-light text-danger" href="contact.php">Contact Us!</a>
                  </li>
                  <div class="space"></div><!--for space between buttons-->
                <li class="nav-item">
                  <a class="nav-link btn btn-light text-danger" href="admin/signOn.php">Admin</a>
                  </li>
                  <div class="space"></div><!--for space between buttons-->
              </ul>
            </div>
            </nav>
            <main>
            <div class="container">
            <div class="row">
              <div class="col-md-4">
                <h3>Drinks</h3>
                <h4>Coffee & Beverages</h4>
                <p>
                  <img class="img-fluid" src="images/coffee.jpg" alt="Coffee in a Cup">
                  <figcaption>Photo by Tyler Nix: <a target="blank" href="https://www.pexels.com/photo/cappuccino-in-white-ceramic-cup-on-white-ceramic-saucer-2396220/">
                    pexels.com
                  </a>
                  </figcaption>
                  <ul>
                  <li>Fresh Roasted Coffee</li>
                  <li>Mocha Latte</li>
                  <li>Hot Chocolate</li>
                  <li>Chai Tea</li>
                  <li>Frappe</li>
                </ul>
                </p>
                <h4>Alchoholic Beverages:</h4>
                <br>
                <h5>Wine</h5>
                <p>
                  Featuring California Cellars Varietals; 
                  <ul>
                    <li>Chardonnay</li>
                    <li>Pinot Grigio</li>
                    <li>Merlot</li>
                    <li>Cabernet Sauvingnon</li>
                  </ul>
                </p>
                <h5>Beer (bottled only)</h5>
                <p>
                  <ul>
                  <li>Budwiser</li>
                  <li>Bud Light</li>
                  <li>Coors</li>
                  <li>Coors Light</li>
                  <li>Blue Moon</li>
                  <li>Exile Ruthie</li>
                  <li>Firetrucker Tropical Burn</li>
                </ul>
                </p>
              </div>
              <div class="col-md-5">
                <h3>Sandwhiches</h3>
                <p>
                  <ul>
                    <?php
                            while($row = $stmt->fetch() ){
                              echo "<li>";
                                  echo "<h5>";
                                      echo $row["item_name"];
                                  echo "</h5>";
                                  
                                      echo $row["item_desc"]. " " .$row["item_price"];
                                  echo "</li>";
                            }
                    ?>
                  </ul>
                </p>
              </div>
              <div class="col-md-3">
                <h3>
                  Other Items
                </h3>
                <h4>Soups</h4>
                <p>
                  <ul>
                    <li><span>Savahana’s Signature Soup:</span> Our famous roasted red pepper & gouda</li>
                    <li><span>Soup of the Day:</span> Always changing, timed for the season & great with a salad or sandwich<br>
                      <span>Bowl:  $4.99    Cup: $3.99</span>
                      </li>
                    <li><span>Soup & Sandwich:</span> Choice of soup & half sandwich (no wraps, bagels or croissants as 1/2 sandwiches) $7.29</li>
                    <li><span>Soup & Salad:</span> Choice of soup & any half salad $7.29</li>
                  </ul>
                </p>
                <h4>Desserts</h4>
                <p>
                  <ul><li><span>Enjoy the EVER Changing & always tasty – BAKERY CASE!</span><br>
                    The Bakery Case Commonly Features:
                  Yogurt, Muffins, Pastries, Quiche, Cigars, Strudels, & Iced Cinnamon Rolls</li>
                </ul>
                <img class="img-fluid" src="images/cinn.jpg" alt="Cinnamon Rolls">
                <figcaption>Photo by Milford Hughes: <a target="blank" href="https://www.pexels.com/photo/a-cinnamon-rolls-on-a-ceramic-plate-8318905/">
                  pexels.com
                </a></figcaption>
                </p>
              </div>
            </div>
          </div>
        </main>
        <a href="index.php#top" class="btn btn-light text-danger back">Back to Home</a>
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