<html>
    <head></head>
    <body>
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
        //basic details
        $fn = $_POST['f_name'];
        $ln = $_POST['l_name'];
        $onic = $_POST['o_nic'];
        $add = $_POST['address'];
        $telno = $_POST['tel_no'];
        $rank = $_POST['rank_id'];
        //login details
        $logname = $_POST['login_name'];
        $psw = $_POST['password'];
        $repsw = $_POST['re_password'];
        $pril = $_POST['pri_level'];
        $adpsw = $_POST['admin_password'];
        
        
        if ($fn == '' || $ln == '' || $onic == '' || $add==''||$telno=='' ||$rank == '' || $logname == '' || $psw == '' || $repsw==''||$pril=='') {
            header('location: officer_acc.php?msg=Fill all input data before add new officer.');
        } else if($adpsw==''){
            header('location: officer_acc.php?msg=Administrative password should be entered.');
        } else if(!($psw==$repsw)){
            header('location: officer_acc.php?msg=Retyped password does not match.'); 
        } else if(!($adpsw=="administrator")){
            header('location: officer_acc.php?msg=Administrative password does not match.Enter again'); 
        } else {
            

            include ('.\DBCon.php');
            //checking peimary key exsistance

            $query1 = "SELECT O_NIC FROM officer WHERE O_NIC=?";
            if ($stmt1 = $con->prepare($query1)) {
                //binding
                $stmt1->bind_param("s", $O_NIC);

                // set parameters and execute
                $O_NIC = $onic;
                $stmt1->execute();

                // store result 
                $stmt1->store_result();
                //checking empty result set
                if (!($stmt1->num_rows == 0)) {
                    $stmt1->close();
                    echo "officer  already exists";
                    echo "return with label officer exist";
                    header('location: officer_acc.php?msg=Officer NIC is already exist.Check again.');
                } else {
                    $stmt1->close();
                    // preparing query1
                    $query = "INSERT INTO officer (O_NIC,first_name,last_name,address,rank_id) VALUES (?,?,?,?,?)";
                    if ($stmt = $con->prepare($query)) {
                        //binding
                        $stmt->bind_param("sssss",$O_NIC,$first_name,$last_name,$address,$rank_id);
                        // set parameters and execute
                        $O_NIC=$onic;
                        $first_name=$fn;
                        $last_name=$ln;
                        $address=$add;
                        $rank_id=$rank;

                        if (!($stmt->execute())) {
                            //createLog(mysql_error());
                            echo "Error,add_officer_acc.php,officer not added at officer table query";
                        } else {

                            echo 'officer added in officer table';
                            
                        }
                    } else {
                        echo "error checklogin.php prepare statement failure";
                    }
                    $stmt->close();
                    
                    
                    // preparing query2
                    $query3 = "INSERT INTO officer_login (O_NIC,user_name,password,priviledge) VALUES (?,?,?,?)";
                    if ($stmt3 = $con->prepare($query3)) {
                        //binding
                        $stmt3->bind_param("ssss",$O_NIC,$user_name,$password,$priviledge);
                        // set parameters and execute
                        $O_NIC=$onic;
                        $user_name=$logname;
                        $priviledge=$pril;
                        $password=  generateHash($psw,"bud");

                        if (!($stmt3->execute())) {
                            //createLog(mysql_error());
                            echo "Error,add_officer_acc.php,officer not added at officer_login query";
                        } else {

                            echo 'officer added';
                            
                        }
                        
                    } else {
                        echo "error checklogin.php preparestatement failure";
                        
                    }
                    $stmt3->close();
                    
                    //telephone queri entering
                    $query4 = "INSERT INTO officer_tp (O_NIC,telephone) VALUES (?,?);";
                    if ($stmt4 = $con->prepare($query4)) {
                        //binding
                        $stmt4->bind_param("ss",$o_nic,$telephone);

                        // set parameters and execute
                        $o_nic=$onic;
                        $telephone=$telno;

                        if (!($stmt4->execute())) {
                            //createLog(mysql_error());
                            echo "Error,addd_officer_acc.php,telephone number not added";
                        } else {

                            echo 'officer telephone num added';
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
