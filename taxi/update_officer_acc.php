<html>
    <head></head>
    <body>
        
        <?php
        /*session starts*/
        session_start();
        if($_SESSION['sid']!=session_id())
        {
            header("location:login.php");
        }
    
    
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
        //basic details
        $usrname = $_SESSION['uname']; 
        $add = $_POST['address'];
        $telno = $_POST['tel_no'];
        $rank = $_POST['rank_id'];
        //login details
        $logname = $_POST['login_name'];
        $psw = $_POST['password'];
        $repsw = $_POST['re_password'];
        $pril = $_POST['pri_level'];
        $adpsw = $_POST['admin_password'];
        $ousrpwd=$_POST['old_usr_password'];
        
        
        if ($add==''||$telno=='' ||$rank == '' || $logname == '' || $psw == '' || $repsw==''||$pril=='') {
            header('location: officer_acc.php?msg=Fill all input data before update current officer.');
        } else if($adpsw==''){
            header('location: officer_acc.php?msg=Administrative password should be entered before update officer data.');
        } else if(!($psw==$repsw)){
            header('location: officer_acc.php?msg=Retyped password does not match.'); 
        } else if(!($adpsw=="administrator")){
            header('location: officer_acc.php?msg=Administrative password does not match.Enter again'); 
         
        } else {
            

            include ('./DBCon.php');
            //checking peimary key exsistance

            $query1 = "SELECT PASSWORD FROM `officer` JOIN officer_login WHERE officer.O_NIC=officer_login.O_NIC and user_name=?";
            if ($stmt1 = $con->prepare($query1)) {
                //binding
                $stmt1->bind_param("s", $username);

                // set parameters and execute
                $username=$usrname;
                $stmt1->execute();

                // store result 
                $stmt1->store_result();
                $stmt1->bind_result($value);
                $stmt1->fetch(); 
                echo $value;
        
                
                //user password match
                if (!(generateHash($ousrpwd,"bud")==$value)){
                    $stmt1->close();
                    echo "officer  password mismatch";
                    echo "return with password mismatch";
                    header('location: officer_acc.php?msg=Officer old password does not match.Check again.');
                } else {
                    $stmt1->close();
                    // preparing query1
                    $query = "UPDATE officer SET address=?, rank_id=? where O_NIC=(SELECT O_NIC from officer_login WHERE user_name=?);";
                    if ($stmt = $con->prepare($query)) {
                        //binding
                        $stmt->bind_param("sss",$address,$rank_id,$user_name);
                        // set parameters and execute
                        
                        $address=$add;
                        $rank_id=$rank;
                        $user_name=$usrname;

                        if (!($stmt->execute())) {
                            //createLog(mysql_error());
                            echo "Error,update_officer_acc.php,officer not updated at officer table query";
                        } else {

                            echo 'officer updated in officer table';
                            
                        }
                    } else {
                        echo "error update_officer_acc.php prepare statement failure";
                    }
                    $stmt->close();
                    
                    
                    // preparing query2
                    $query3 = "UPDATE officer_login SET user_name=?,password=?,priviledge=? Where user_name=?;";
                    if ($stmt3 = $con->prepare($query3)) {
                        //binding
                        $stmt3->bind_param("ssss",$user_name,$password,$priviledge,$old_user_name);
                        // set parameters and execute
                        
                        $user_name=$logname;
                        $priviledge=$pril;
                        $password=  generateHash($psw,"bud");
                        $old_user_name=$usrname;
                        if (!($stmt3->execute())) {
                            //createLog(mysql_error());
                            echo "Error,update_officer_acc.php,officer not updated at officer_login query";
                        } else {

                            echo 'officer updated';
                            header('location: officer_acc.php?msg=');
                        }
                        
                    } else {
                        echo "error update_officer_acc.php preparestatement failure";
                        
                    }
                    $stmt3->close();
                    
                    //telephone queri entering
                    $query4 = "UPDATE officer_tp SET telephone=? WHERE O_NIC=?;";
                    if ($stmt4 = $con->prepare($query4)) {
                        //binding
                        $stmt4->bind_param("ss",$telephone,$o_nic);

                        // set parameters and execute
                        $o_nic=$onic;
                        $telephone=$telno;

                        if (!($stmt4->execute())) {
                            //createLog(mysql_error());
                            echo "Error,addd_officer_acc.php,telephone number not updated";
                        } else {

                            echo 'officer telephone num updated';
                            header('location: officer_acc.php?msg=');
                        }
                    } else {
                        echo "error add_oficer_acc.php preparestatement failure";
                    }
                    $stmt4->close();                  
                    
                }

                // close statement 


                $con->close();
            }
        }
        
        
        ?>



    </body>
</html>
