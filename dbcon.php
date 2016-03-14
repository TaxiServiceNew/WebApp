<?php

$mysql_host = 'localhost';
$mysqluser = 'buddhiayesha';
$mysqlpass = '0773432552ijse4E';
$database = 'smarttaxidb';


$con = mysql_connect($mysql_host, $mysqluser, $mysqlpass);
$db = mysql_select_db($database);

if(!$con){
    die("Can't connect to server");
}
if(!$db){
    die("Can't connect to databases");
}

?>