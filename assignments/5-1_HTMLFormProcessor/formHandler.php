<?php
if (isset($_POST["programInfo"])){
	$programInfo = $_POST["programInfo"];
}
else {
	$programInfo = "";
}

if (isset($_POST["advisorContactInfo"])){
	$contactInfo = $_POST["advisorContactInfo"];
}
else {
	$contactInfo = "";
}

if (isset($_POST["comments"])){
	$comments = $_POST["comments"];
}
else {
	$comments = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>5-1: HTML Form Processor</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	
</body>
</html>

<body>
<h1>WDV341 Intro PHP</h1>
<h2>5-1: HTML Form Processor</h2>
<div id="response">
	<header>Form Submitted Successfully</header>
	<p>
        Dear <?php echo $_POST["firstName"]; ?>,<br>
		Thank for you for your interest in DMACC.<br><br>
		We have you listed as a <?php echo $_POST["academicStanding"]; ?> starting this fall.<br>
		You have declared <?php echo $_POST["selectedMajor"]; ?> as your major.<br>
		Based upon your responses we will provide the following information 
		in our confirmation email to you at <?php echo $_POST["emailAddress"]; ?>.<br><br>
		<?php 
		if (isset($programInfo)) {
			echo $programInfo, "<br>";
		}
		else {
			//outputs nothing
		}
		?>
		<?php
		if (isset($contactInfo)) {
			echo $contactInfo, "<br>";
		}
		else {
			//outputs nothing
		}
		?>
		<br><br>
		You have shared the following comments which we will review:<br>
		<?php
				if (isset($comments)) {
					echo $comments, "<br>";
				}
				else {
					//outputs nothing
				}
		?>
    </p>
</div>
Table to verify that reCAPTCHA is successfully connected and running
		<?php
		echo "<table border='1'>";
echo "<tr><th>Field Name</th><th>Value of field</th></tr>";
foreach($_POST as $key => $value)
{
    echo '<tr class=colorRow>';
    echo '<td>',$key,'</td>';
    echo '<td>',$value,'</td>';
    echo "</tr>";
} 
echo "</table>";
echo "<p>&nbsp;</p>";
?>
</body>
</html>
