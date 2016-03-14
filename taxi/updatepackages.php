<html>
    <head></head>
    <body>
        <?php
        $pid = $_POST['package-id'];
        $dscp = $_POST['discription'];
        $ppkm = $_POST['price-per-km'];
        $ppday = $_POST['price-per-day'];

        if ($pid == '' || $dscp == '' || $ppkm == '' || $ppday=='') {
            header('location:packages.php?msg=Fill all input data for package before submission.');
        } else {

            include ('.\DBCon.php');
            //checking peimary key exsistance
            // preparing 
            
            $query = "UPDATE package SET detail=?,per_km=?,per_day=? WHERE package_id=?";
            if ($stmt = $con->prepare($query)) {
                //binding
                $stmt->bind_param("ssss",$detail, $per_km, $per_day,$package_id);

                // set parameters and execute
                $package_id = $pid;
                $detail = $dscp;
                $per_km = $ppkm;
                $per_day = $ppday;

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
        
        
        ?>



    </body>
</html>
