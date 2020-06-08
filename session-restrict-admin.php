<?php

    if (empty($_SESSION['id'] || isCookieValid($db))) {
       
        header('location: login.php');

    }

?> 