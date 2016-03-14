<?php 
    session_start();
    if($_SESSION['sid']!=session_id())
    {
	header("location:login.php");
    }
    $uname=$_SESSION['uname'];
?>
<!DOCTYPE html>
<!-- Written by YOHAN-->
<html manifest="cache.appcache">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>OneClick Taxi: Home</title>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="./css/basic.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </head>
    <body>

        <?php
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
        } else {
            $msg = "";
        }
        ?>

        <div id="page">
            <header id="header"> 
                <div id="header-inner">
                    <div id="logo">
                        <h1>OneClick <span>Taxi</span> Service</h1>
                    </div>
                    <div id="clr1"></div>
                    <div id="top-nav">
                        <ul>
                            <li><a href="about.html">About</a></li>
                            <li>&#124;</li>
                            <li><a href="./logout.php">Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </header>
            <div id="feature">
                <div id="feature-inner">
                    <h1>User : <?php echo $uname?></h1>
                </div>
            </div>
            <div id="content">
                <div id="content-inner">
                    <div id="content-up"></div>
                    <div id="content-middle">
                        <! web page middle >
                        <div id="button-pannel">
                            <ul class="nav nav-tabs">
                                <li><a href="./home.php">Home</a></li>
                                <li><a href="./emb_devices.php">Emb. Devices</a></li>
                                <li><a href="./drivers.php">Drivers</a></li>
                                <li class="active"><a href="#">Vehicles</a></li>
                                <li><a href="./packages.php">Packages</a></li>
                                <li><a href="#">Resevation</a></li>
                                <li><a href="./officer_acc.php">Officer Accounts</a></li>
                            </ul>

                            <!---------Content------->
                            <div class="content">
                                <h3>Vehicle Details</h3>
                                <p>Details about vehicle, vehicle classes can be add, update or view.</p>
                                <!-------Error Message-------->
                                <div id="error_massege"><?php echo $msg ?></div>
                                <br>
                            </div>

                            <div class="container">
                                <ul class="nav nav-pills">
                                    <li class="active"><a data-toggle="pill" href="#add_new">Add New</a></li>
                                    <li><a data-toggle="pill" href="#update">Update</a></li>
                                    <li><a data-toggle="pill" href="#view">View Details</a></li>
                                    <li><a data-toggle="pill" href="#new_vehicle_type">Add Vehicle Type</a></li>
                                    <li><a data-toggle="pill" href="#current_vehicle_type">Vehicle Types</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="add_new" class="tab-pane fade in active">
                                        <h5>Add new device details</h5>
                                        <form class="form-horizontal" role="form" method="post" action="addvehicle.php">
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="reg_number">Reg Number:</label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" name="reg_num" placeholder="ID">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="sel1">Type ID:</label>
                                                <div class="col-sm-1">
                                                    <select class="form-control" name="type_id">
                                                        <option> </option>
                                                        <?php
                                                            include('DBCon.php');
                                                            $result = mysqli_query($con,"SELECT type_id,detail FROM vehicle_type");
                                                            while ($row = mysqli_fetch_array($result)){
                                                                echo '<option>'.$row['type_id'].'</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="seats">Seats:</label>
                                                <div class="col-sm-1">
                                                    <input type="text" class="form-control" name="seats">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-1">
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="with_ac"  value="true" unchecked>With AC</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-2">
                                                    <button type="submit" class="btn btn-default">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div id="update" class="tab-pane fade">
                                        <h5>Update existing device details</h5>

                                        <form class="form-horizontal" role="form" method="post" action="updatevehicle.php">
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="reg_num">Reg Number:</label>
                                                <div class="col-sm-2">
                                                    <select class="form-control" name="reg_num">
                                                        <option> </option>
                                                        <?php
                                                            include('DBCon.php');
                                                            $result = mysqli_query($con,"SELECT reg_number FROM vehicle");
                                                            while ($row = mysqli_fetch_array($result)){
                                                                echo '<option>'.$row['reg_number'].'</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="discription">Type ID:</label>
                                                <div class="col-sm-1">
                                                    <select class="form-control" name="type_id">
                                                        <option> </option>
                                                        <?php
                                                            include('DBCon.php');
                                                            $result = mysqli_query($con,"SELECT type_id FROM vehicle_type");
                                                            while ($row = mysqli_fetch_array($result)){
                                                                echo '<option>'.$row['type_id'].'</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="seats">Seats:</label>
                                                <div class="col-sm-1">
                                                    <input type="text" class="form-control" name="seats">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-1">
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="with_ac"  value="true" unchecked>With AC</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-2">
                                                    <button type="submit" class="btn btn-default">Submit</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                    <div id="view" class="tab-pane fade">
                                        <h5>View Details</h5>                                        
                                        <div class="col-sm-5">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Registration Number</th>
                                                        <th>Type</th>
                                                        <th>No of Seats</th>
                                                        <th>With AC facility</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        include('DBCon.php');
                                                        $result = mysqli_query($con,"SELECT * FROM vehicle JOIN vehicle_type WHERE vehicle.type_id=vehicle_type.type_id");
                                                        while ($row = mysqli_fetch_array($result)){
                                                            echo '<tr>';
                                                            echo '<td>'.$row['reg_number'].'</td>';
                                                            echo '<td>'.$row['detail'].'</td>';
                                                            echo '<td>'.$row['seats'].'</td>';
                                                            echo '<td>'.$row['with_ac'].'</td>';
                                                            echo '</tr>';
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="new_vehicle_type" class="tab-pane fade">
                                        <h5>Add new vehicle type</h5>
                                        <form class="form-horizontal" role="form" method="post" action="add_vehicle_type.php">
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="type_id">Type ID:</label>
                                                <div class="col-sm-1">
                                                    <input type="text" class="form-control" name="type_id" placeholder="ID">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="detail">Detail:</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" name="detail">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-default">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div id="current_vehicle_type" class="tab-pane fade">
                                        <h5>Vehicle type Details</h5>
                                        <div class="col-sm-5">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Type ID</th>
                                                        <th>Details</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        include('DBCon.php');
                                                        $result = mysqli_query($con,"SELECT * FROM vehicle_type");
                                                        while ($row = mysqli_fetch_array($result)){
                                                            echo '<tr>';
                                                            echo '<td>'.$row['type_id'].'</td>';
                                                            echo '<td>'.$row['detail'].'</td>';
                                                            echo '</tr>';
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>