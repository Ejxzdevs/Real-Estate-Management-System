<?php 
session_start();
unset($_SESSION['user_type']);
header("Location: /Vanilla-Php/Real-Estate-Management-System/index.php"); 
exit();

