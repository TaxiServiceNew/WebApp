<html>
    <head></head>
    <body>
        <?php
        $pid = $_POST['package-id'];
        $dscp = $_POST['discription'];
        $ppkm = $_POST['price-per-km'];
        $ppday = $_POST['price-per-day'];
        

       
        
        
        
        if ($pid == '' || $dscp == '' ||  $ppkm == '' || $ppday=='') {
            header('location:packages.php?msg=Fill all input data for package before submission.');
        } else {

            include ('./DBCon.php');
            //checking peimary key exsistance

            $query1 = "SELECT package_id FROM package WHERE package_id=?";
            if ($stmt1 = $con->prepare($query1)) {
                //binding
                $stmt1->bind_param("s", $package_id);

                // set parameters and execute
                $package_id = $pid;
                $stmt1->execute();

                // store result 
                $stmt1->store_result();
                //checking empty result set
                if (!($stmt1->num_rows == 0)) {
                    $stmt1->close();
                    echo "package  already exists";
                    echo "return with label package exist";
                    header('location: packages.php?msg=Package id is already exist.Enter new one.');
                } else {
                    $stmt1->close();
                    // preparing 
                    $query = "INSERT INTO package (package_id,detail,per_km,per_day) VALUES (?,?,?,?)";
                    if ($stmt = $con->prepare($query)) {
                        //binding
                        $stmt->bind_param("ssss",$package_id,$detail,$per_km,$per_day);

                        // set parameters and execute
                        $package_id=$pid;
                        $detail=$dscp;
                        $per_km=$ppkm;
                        $per_day=$ppday;

                        if (!($stmt->execute())) {
                            //createLog(mysql_error());
                            echo "Error,addpackages.php,package not added";
                        } else {

                            echo 'package added';
                            header('location: packages.php?msg=');
                        }
                    } else {
                        echo "error addpackages.php prepare statement failure";
                    }
                    $stmt->close();
                }

                // close statement 


                $con->close();
            }
        }
        
        
        ?>



    </body>
</html>
