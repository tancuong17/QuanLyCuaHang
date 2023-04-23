<?php
    session_start();
    if($_SESSION['login'] == 0)
        echo 0;
    else
        echo 1;
?>