<?php
		$message_sent = false;
if(isset($_POST["emailAddress"]) && $_POST["emailAddress"] !=''){

	if(filter_var($_POST["emailAddress"], FILTER_VALIDATE_EMAIL) ){
		// submit the form
		$firstName = $_POST["firstName"];
		$lastName = $_POST["lastName"];
		$emailAddress = $_POST["emailAddress"];
		$coffeeMsg = $_POST["coffee"];
		$fav = $_POST["fav"];

		$to = "seth.clapp22@gmail.com, $emailAddress";
		$messageSubject = "Savanna's Coffee House Contact Form Response";
		$body = "";

		$body .= "From: " . $firstName . " " . $lastName . "\r\n";
		$body .= "Email: " . $emailAddress . "\r\n";
		$body .= $firstName . " likes their coffee " . $coffeeMsg . "\r\n";
		$body .= $firstName . "'s favorite thing about coffee is " . $fav . "\r\n";

		mail($to,$messageSubject,$body);

		$message_sent = true;
	}

}



?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
          Savanna's Coffee House Contact Form
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
  <meta name="description" content="Savanna's Coffee House Contact Form">
  <meta name="keywords" content="Savanna's, Coffee, House, Contact, Form, Contact Us, Forms">
  <style>
		p {
    	color: black;
					}
  </style>
    </head>
    <body>
      <?php
      if($message_sent){
      ?>
<!-- Form Response -->
<header>
            <div class="mt-4 p-5 ">
			<img class="img-fluid " src="images/banner.jpg" alt="Savanna's Coffee House Logo" width="auto" height="auto"><br><br>
              <h1>Results</h1>
            </div>
          </header>
		  <main>
            <div class="container">
            <div class="row">
              <div class="col" style="background-color:#aaa;">

					<p>
						Thank you for your feedback <?php echo $firstName . " " . $lastName;?>,<br>
						your information was submitted successfully!
				</p>
			  </div><!--End of container-->
            </div>
          </div>
        </main>
<a href="index.php#top" class="btn btn-light text-danger back">Back to Home</a>
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
<!--End of form response-->
      <?php
      }
      else{
      ?>
        <header>
            <div class="mt-4 p-5 ">
              <img class="img-fluid " src="images/banner.jpg" alt="Savanna's Coffee House Logo" width="auto" height="auto"><br><br>
              <h1>Contact Us!</h1>
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
              <div class="col" style="background-color:#aaa;">	<form id="contact_form" method="post" action="contact.php">
                <legend>Contact Us!</legend>
                <p style="font-style:italic;">Tell Us About Yourself!</p>
                <p>
                  <label for="firstName">First Name:</label> 
                  <input type="text" name="firstName" id="firstName" required>
                </p>
                
                <p>
                  <label for="lastName">Last Name:</label> 
                  <input type="text" name="lastName" id="lastName" required>
                </p>

                <p>
                  <label for="emailAddress">Email Address:</label>
                  <input type="email" name="emailAddress" id="emailAddress" required>
                </p>

                <p>
                  <label for="favFood">Favorite Food:</label>
                  <input type="text" name="favFood" id="favFood">
                </p>
                    <br>
                    <img class="img-fluid" src="images/coffee2.jpg" alt="Coffee in Hands">
                    <figcaption>
                      Photo by Porapak Apichodilok: <a target="_blank" href="https://www.pexels.com/photo/woman-holding-mug-of-cappuccino-373639/">
                        pexels.com
                      </a>
                    </figcaption>
                              <label for="coffee">How do you like your Coffee?</label>
                              <br>
                              <textarea id="coffee" name="coffee" maxlength="3000" required></textarea>
                              <br><br>
                              <p>What is Your Favorite thing About Coffee?</p>
                              <input type="radio" id="smell" name="fav" value="The Smell" required>
                              <label for="smell">The Smell</label><br>
                              <input type="radio" id="taste" name="fav" value="The Taste">
                              <label for="taste">The Taste</label><br>
                              <input type="radio" id="energy" name="fav" value="The Energy it Gives Me">
                              <label for="energy">The Energy it Gives Me</label><br>
                              <input type="radio" id="everything" name="fav" value="Everything About It">
                              <label for="everything">Everything About It</label><br>
                  <br><br>
                    <input type="submit" id="button" name="button" value="Submit">
                    <input type="reset" id="button" name="button" value="Reset">
                  </form>
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
<?php
}
?>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" 
  integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" 
integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    </body>
</html>