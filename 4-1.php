<?php
/*
Instructions:

Create a function that will accept a timestamp and format it into mm/dd/yyyy format.    -done

Create a function that will accept a timestamp and format it into dd/mm/yyyy format to use when working with international dates.   -done

Create a function that will accept a string input.  It will do the following things to the string:     -done
        Display the number of characters in the string
        Trim any leading or trailing whitespace
        Display the string as all lowercase characters
        Will display whether or not the string contains "DMACC" either upper or lowercase

Create a function that will accept a number and display it as a formatted phone number.   Use 1234567890 for your testing.  -done

Create a function that will accept a number and display it as US currency with a dollar sign.  Use 123456 for your testing. -done
*/




function americanDateFormat(){
    $date=date_create();
date_timestamp_set($date,1698710400);
return date_format($date,"m/d/Y");
}

function internationalDateFormat(){
    $date=date_create();
    date_timestamp_set($date,1698710400);
    return date_format($date,"d/m/Y");
}



function formatString($inSchoolName){
    echo "This School Name conatains " . strlen($inSchoolName) . " characters.";
    echo "<br>";
    echo "Your School Name is:" . strtolower(trim($inSchoolName, " ")) . ".";
    echo "<br>";
    if (strtolower(trim($inSchoolName, " ")) == "dmacc") {
        echo "Does School Name contain the word DMACC? Yes";
    } elseif (strtoupper(trim($inSchoolName, " ")) == "DMACC") {
        echo "Does School Name contain the word DMACC? Yes";
    } else {
        echo "Does School Name contain the word DMACC? No";
    }

}

function formatPhoneNumber($inPhoneNumber) {
    $format_phone =
    substr($inPhoneNumber, -10, -7) . "-" .
    substr($inPhoneNumber, -7, -4) . "-" .
    substr($inPhoneNumber, -4);
    echo "Phone Number: " . $format_phone;
}

function formatCurrency($inCurrency) {
    $currency = '$';
    $formatted_number = $currency . number_format($inCurrency, 2);
    echo "123456 formatted as US Currency: " . $formatted_number;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4-1: PHP Functions</title>
    <style>
        body {
            background-color: rgb(200, 80, 63);
            text-align: center;
            color:aliceblue;
            text-shadow: 3px 3px rgba(0, 0, 0, 0.144);
        }
    </style>
</head>
<body>
    <h1>WDV341 Intro PHP</h1>
    <h2>4-1: PHP Functions</h2>
    <h3>Halloween is on: <?php echo americanDateFormat() . " or " . internationalDateFormat() . " internationally."?></h3>
    <h3><?php formatString(" DmAcC    "); ?></h3>
    <h3><?php formatPhoneNumber("1234567890"); ?></h3>
    <h3><?php formatCurrency("123456");?></h3>
</body>
</html>