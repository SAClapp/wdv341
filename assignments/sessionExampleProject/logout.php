<?php
    session_start();

    session_unset();
    session_destroy();

    //redirect to application home or login page
    header("Location: signOn.php");

?>