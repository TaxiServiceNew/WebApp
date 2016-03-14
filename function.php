<?php

header('Content-Type: application/json');
include './connection.php';

$result = array();

define('SALT_LENGTH', 9);

if (isset($_GET['functionname'])) {
    if ('selectuser' == $_GET['functionname']) {
        selectUser();
    }
    if ('selectusername' == $_GET['functionname']) {
        selectUserName();
    }
    if ('dbsignup' == $_GET['functionname']) {
        dbsignup();
    }
    if ('dbdriverview' == $_GET['functionname']) {
        dbdriverview();
    }
	if ('drivertp' == $_GET['functionname']) {
        drivertp();
    }
    

}

function selectUser() {
    $username = $_GET['un'];
    $password = $_GET['pw'];
    $query = "SELECT C_NIC FROM customer_login where user_name='$username' and password='$password'";

    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            if ($row = mysql_fetch_assoc($query_run)) {
                print(json_encode($row));
            }else{
                print(json_encode(NULL));
            }
        }
    }
}

function selectUserName() {
    $userId = $_GET['id'];
    $query = "SELECT username FROM user where id='$userId'";

    if ($query_run = mysql_query($query)) {

        if (mysql_num_rows($query_run) != NULL) {
            if ($row = mysql_fetch_assoc($query_run)) {
                print(json_encode($row));
            }else{
                print(json_encode(NULL));
            }
        }
    }
    
}


function dbsignup() {
    $username = $_GET['un'];
    $password = $_GET['pw'];
	
	$firstName = $_GET['firstName'];
	$lastName = $_GET['lastName'];
	$NIC = $_GET['NIC'];
	$password = $_GET['password'];
	$address = $_GET['address'];
	$telHome = $_GET['telHome'];
	$telMobile = $_GET['telMobile'];
	$userName = $_GET['userName'];
	
	$query1 = "INSERT INTO customer VALUES('$NIC','$firstName','$lastName','$address')";

    if ($query_run = mysql_query($query1)) {
        $query2 = "INSERT INTO customer_login VALUES('$NIC','$userName','$password')";

		if ($query_run2 = mysql_query($query2)) {
			$checkNum=0;
			if($telHome!="no"){
				$query3 = "INSERT INTO customer_tp VALUES('$NIC','$telHome');";
				if ($query_run3 = mysql_query($query3)) {					
					$checkNum=1;
				}
			}
			
			if($telMobile!="no"){
				$query4 = "INSERT INTO customer_tp VALUES('$NIC','$telMobile');";
				if ($query_run4 = mysql_query($query4)) {					
					$checkNum=1;
				}
			}
			
			if($checkNum==1){
				print("true");
			}
			else{
				print("false");
			}
			
		}
		else{
			print("false");
		}
    }
	else{
		print("false");
	}
}

function dbdriverview() {
    $d_nic = $_GET['d_nic'];
	$query = "SELECT * FROM `driver_view` WHERE D_NIC='$d_nic' LIMIT 1";
	
	if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            if ($row = mysql_fetch_assoc($query_run)) {
                print(json_encode($row));
            }else{
                print(json_encode(NULL));
            }
        }
    }
}


function generateHash($plainText, $salt = null)
{
    
    if ($salt === null)
    {
        $salt = substr(md5(uniqid(rand(), true)), 0, SALT_LENGTH);
    }
    else
    {
        $salt = substr($salt, 0, SALT_LENGTH);
    }
    
    return $salt.sha1($salt.$plainText);
}

function drivertp(){
	
	$query = "SELECT * FROM driver_tp";
	
	if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            if ($row = mysql_fetch_assoc($query_run)) {
                print(json_encode($row));
            }else{
                print(json_encode(NULL));
            }
        }
    }
	
}


?>