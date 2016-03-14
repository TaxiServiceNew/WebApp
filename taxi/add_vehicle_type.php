<html>
    <head></head>
    <body>
        <?php
        $tid = $_POST['type_id'];
        $dtl = $_POST['detail'];
        
        echo 'type_id'.$tid;
        echo 'detail'.$dtl;
       
        if ($tid  == '' || $dtl == '') {
            header('location: vehicles.php?msg=Fill all vehicle type data before enter.');
        } else {

            include ('./DBCon.php');
            //checking peimary key exsistance

            $query1 = "SELECT type_id FROM vehicle_type WHERE type_id=?";
            if ($stmt1 = $con->prepare($query1)) {
                //binding
                $stmt1->bind_param("s", $type_id);

                // set parameters and execute
                $type_id = $tid;
                $stmt1->execute();

                // store result 
                $stmt1->store_result();
                //checking empty result set
                if (!($stmt1->num_rows == 0)) {
                    $stmt1->close();
                    echo "vehicle _type  already exists";
                    echo "return with label device exist";
                    header('location: drivers.php?msg=vehicle _type is already exist.Enter new one.');
                } else {
                    $stmt1->close();
                    // preparing 
                    $query2 = "INSERT INTO vehicle_type (type_id,detail) VALUES (?,?)";
                    if ($stmt2 = $con->prepare($query2)) {
                        //binding
                        $stmt2->bind_param("ss",$type_id,$detail);

                        // set parameters and execute
                        $type_id=$tid;
                        $detail=$dtl;

                        if (!($stmt2->execute())) {
                            //createLog(mysql_error());
                            echo "Error,add_vehicle_type.php,vehicle type not added";
                        } else {
                            echo 'vehicle type added';
                            header('location: drivers.php?msg=');
                        }
                        $stmt2->close();
                    } else {
                        echo "error checklogin.php prepare statement failure";
                    }
                    
                }

                // close statement 


                $con->close();
            }
        }
        
        
        ?>



    </body>
</html>
