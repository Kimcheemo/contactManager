<?php

//destroy session varaibles to log us out of account
session_start();
session_unset();
session_destroy();

//sends user to front page
//header("location: ../home.php");
//exit()