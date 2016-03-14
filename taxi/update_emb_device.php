<html>
    <head>

    </head>
    <body>
        <?php
        $did = $_POST['sel1'];
        $disp = $_POST['discription'];
        $ser = $_POST['onservice'];
        $bdate = $_POST['bought_date'];
        $edate = $_POST['end_date'];

        if (strlen($did) > 3) {
            echo "did is larger than 3 characters";
            echo "return to main page again with massage";
            header('location: emb_devices.php?msg=Device id is larger than 3 characters.Enter again.');
        } else if ($disp == '' || $bdate == '' || $edate == '') {
            header('location: emb_devices.php?msg=Fill all input data before submission.');
        } else {
            include ('./DBCon.php');
            //checking peimary key exsistance

            $query1 = "SELECT device_id FROM device WHERE device_id=?";
            if ($stmt1 = $con->prepare($query1)) {
                //binding
                $stmt1->bind_param("s", $dev_id);

                // set parameters and execute
                $dev_id = $did;
                $stmt1->execute();

                /* store result */
                $stmt1->store_result();
                //checking empty result set
                if ($stmt1->num_rows == 0) {
                    $stmt1->close();
                    echo "deivece  does not exist.";
                    header('location: emb_devices.php?msg=Device id is not exist.Enter proper device id for update.');
                } else {
                    $stmt1->close();
                    // preparing 
                    $query = "UPDATE device SET description=?,on_service=?,bought_date=?,end_date=? WHERE device_id=?";
                    if ($stmt = $con->prepare($query)) {
                        //binding
                        $stmt->bind_param("sssss",$description, $on_service, $bought_date, $end_date, $device_id);

                        // set parameters and execute
                        $device_id = $did;
                        $description = $disp;
                        if ($ser == 'true') {
                            $on_service = 1;
                        } else {
                            $on_service = 0;
                        }
                        $on_service = $ser;
                        $bought_date = $bdate;
                        $end_date = $edate;

                        if (!($stmt->execute())) {
                            //createLog(mysql_error());
                            echo "Error,addembDevice.php,device not added";
                        } else {

                            echo 'device updated';
                            header('location: emb_devices.php?msg=');
                        }
                    } else {
                        echo "error checklogin.php preparestatement failure";
                    }
                    $stmt->close();
                }
            }
        }
        ?> 
    </body>
</html>



