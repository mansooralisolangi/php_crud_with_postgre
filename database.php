<?php


$localhost = "localhost";
$username = "postgres";
$password = "1234";
$postgreSQL_port = "5432";
$dbname = "user_db";

$con = pg_connect("host=$localhost port=$postgreSQL_port dbname=$dbname user=$username password=$password");


if(!$con){
    echo "connection faild ";
}

?>