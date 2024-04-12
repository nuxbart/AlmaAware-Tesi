<?php
session_start();
require_once("functions.php");
require_once("database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "almaware", 3306);
?>