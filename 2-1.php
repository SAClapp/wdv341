<?php

$yourName = "Seth Clapp";

$number1 = "12";

$number2 = "64";

$total = $number1 + $number2;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2-1: PHP Basics</title>
    <script>

        let codingLanguages = [<?php
        $codingLanguages = array("PHP","HTML","Javascript");

        foreach ($codingLanguages as $name) {
            echo "'$name',";
        }   
        
        
        ?>];

        console.log(codingLanguages);

        codingLanguages = [
        <?php
        $codingLanguages = array("'PHP'","'HTML'","'Javascript'");
        echo implode(",",$codingLanguages);
        
        ?>];      //PHP implode loaded values into the array
    </script>
    <!--
 1.   Create a variable called yourName.  Assign it a value of your name.   -done

 2.   Display the assignment name in an h1 element on the page. Include the elements in your output.    -done

 3.   Use HTML to put an h2 element on the page. Use PHP to display your name inside the element using the variable.    -done

 4.   Create the following variables:  number1, number2 and total.  Assign a value to them.     -done

 5.   Display the value of each variable and the total variable when you add them together.     -done

 6.   Create a PHP variable that is an array containing the values 'PHP', 'HTML' and 'Javascript'. 
    Then, use a PHP loop to iterate through the array and create a javascript array that contains those values. 
    Lastly, write a javascript script that displays the values of the array on the page.    -done
    -->

</head>
<body>
    <h1>2-1: PHP Basics</h1>
    <h2>
        <?php
        
        echo "Your name is: " . $yourName;
        
        ?> 
        </h2>
        <h2>
            <?php

            echo $number1 . " + " . $number2 . " = " . $total;
            
            
            ?>

        <h2>
            <script>
                document.write(codingLanguages);
            </script>
        </h2>
</body>
</html>