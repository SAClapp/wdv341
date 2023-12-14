<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
          Savanna's Coffee House Homepage
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
  <meta name="description" content="Savanna's Coffee House Homepage">
  <meta name="keywords" content="Savanna's, Coffee, House, Home, Homepage">
    </head>
    <body>
        <header>
            <div class="mt-4 p-5 ">
              <img class="img-fluid " src="images/banner.jpg" alt="Savanna's Coffee House Logo" width="auto" height="auto"><br><br>
              <h1>Welcome to Savanna's Coffee House!</h1>
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
              <div class="col-md-8"><h2>Our Mission:</h2>
                <p class="info">
                  At Savanna's Coffee House our goal is to provide you with the best coffee freshly roasted with the best beans from around the world,
                  at an affordable price.
                  But coffee isn't all we do here! We also offer a variety of other items from delicious
                  sandwhiches to homemade soups. We even have a variety of baked goods such as pastries and cakes among other delious things!
                  Not in the mood for coffee? We offer alchoholic beverages including a variety of wines and beers and even live music so you can have a good time
                  and unwind with your friends no matter what mood you are in. Curious what we have? Check out our <a href="menu.php">menu</a> today!
                  Also don't forget to check our <a href="events.php">events</a> page to see what events are coming up soon!
                </p>
                <img src="images/shop.jpg" alt="Inside Coffee Shop">
                <figcaption>
                  Photo by Emre Can Acer:<a target="_blank" href="https://www.pexels.com/photo/lighted-pendant-lights-inside-bar-2079438/">
                    pexels.com
                  </a> 
                </figcaption>
              </div>
              <div class="col-md-4"><h2>Featured Event:</h2>
                <h3>Sunday Songwriters Songfest</h3>
                <h4>#tribe-events-header</h4>
                <img src="images/stage.jpg" class="img-fluid">
                  <figcaption>
                    Photo by Maor Attias
                  </figcaption>
                  <h4>When:</h4>
                <h5>
                  <ul>
                    <li>
                      February 21 @ 4:00 pm - 7:00 pm
                    </li>
                  </ul>
                </h5>
                  <h4>Featuring:</h4>
                  <h5>
                  <ul>
                    <li>Kate Macleod – Award-winning Americana Songwriter.</li>
                    <li>Joel Bernstein – Up & Coming Folk/Pop Songwriter.</li>
                  </ul>
                </h5>
            </div>
          </div>
        </main>
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