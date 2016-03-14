<html>
    <head></head>
    <body>
        <?php
        $rnum = $_POST['reg_num'];
        $type = $_POST['type_id'];
        $seatno = $_POST['seats'];
        $acchk = $_POST['with_ac'];

        if ($rnum == '' || $type == '' || $seatno == '') {
            header('location: vehicles.php?msg=Fill all vehicle input data before update.');
        } else {

            include ('.\DBCon.php');
            //checking peimary key exsistance
            // preparing 
            $query = "UPDATE vehicle SET with_ac=?,type_id=?,seats=? WHERE reg_number=?";
            if ($stmt = $con->prepare($query)) {
                //binding
                $stmt->bind_param("ssss", $with_ac, $type_id, $seats, $reg_number);

                // set parameters and execute
                $reg_number = $rnum;
                if ($acchk == 'true') {
                    $with_ac = 1;
                } else {
                    $with_ac = 0;
                }
                $type_id = $type;
                $seats = $seatno;

                if (!($stmt->execute())) {
                //createLog(mysql_error());
                    echo "Error,updatevehicle.php,vehicle not updates";
                } else {

                    echo 'vehicle updated';
                header('location: vehicles.php?msg=');
                }
            } else {
                echo "error checklogin.php preparestatement failure";
            }
        $stmt->close();
        }

        // close statement 


        $con->close();

        
        ?>



    </body>
</html>
