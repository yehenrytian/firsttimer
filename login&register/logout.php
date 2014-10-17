<?php
session_start(); 
unset($_SESSION['user']);
header("Location: login2.php?msg=You have successfully logged out!");
?> 
