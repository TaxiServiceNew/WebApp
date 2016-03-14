<?php
//define function for encryption
        define('SALT_LENGTH', 9);
        function generateHash($plainText, $salt = null){    
            if ($salt === null){
                $salt = substr(md5(uniqid(rand(), true)), 0, SALT_LENGTH);
            }
            else{
                $salt = substr($salt, 0, SALT_LENGTH);
            }    
            return $salt.sha1($salt.$plainText);
        }
        
$username = $_POST['name'];
$pw = $_POST['pwd'];


include ('./DBCon.php');

// preparing 
$query = "SELECT password FROM officer_login WHERE user_name=?";
if ($stmt = $con->prepare($query)) {
    //binding
    $stmt->bind_param("s", $username);

    // set parameters and execute
//    $u_name = $username;
    $stmt->execute();

    /* store result */
    $stmt->store_result();
    //checking empty result set
    if ($stmt->num_rows == 0) {
        echo "NO such login name";
        header('location: login.php?msg=Invalid username.Enter again.');
    } else {
        //result set non empty
        /* bind result variables */
        $stmt->bind_result($pwd);

        /* fetch values */
        /* while ($stmt->fetch()) {
          echo $pwd;
          } */
        if ($stmt->fetch()) {
            $encppwd=generateHash($pw,"bud");
            if ($pwd ==$encppwd ) {
                //Starting the session
                session_start();
		$_SESSION['sid']=session_id();
		//$_SESSION['uid']=$row['user_id'];
		$_SESSION['uname']=$username;
                //Redirecting to home page
                header('location: home.php?msg='.$username);
            } else {
                
                header('location: login.php?msg=Invalid password.Enter again.');
            }
        }
    }
} else {
    echo "error checklogin.php preparestatement failure";
}

/* close statement */
$stmt->close();

$con->close();



/*
  if ($un == 'abc' && $pw == '123') {
  header('location: index.php');
  } else {
  header('location: index.php?msg=error');
  }
 */
?>


