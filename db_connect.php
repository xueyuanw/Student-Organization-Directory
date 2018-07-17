<?php

// 1. Establish DB Connection
$host = "...";
$username = "xueyuanw";
$password = " ...";
$database = "xueyuanw_uscorg";


$conn = mysqli_connect($host,$username,$password,$database);
if(mysqli_connect_errno()){
    exit("DB Connection Error: " . mysqli_connect_error());
}