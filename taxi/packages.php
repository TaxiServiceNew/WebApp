<?php 
    session_start();
    if($_SESSION['sid']!=session_id())
    {
	header("location:login.php");
    }
    $uname=$_SESSION['uname'];
?><!DOCTYPE html>
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
                                <li><a href="./vehicles.php">Vehicles</a></li>
                                <li class="active"><a href="">Packages</a></li>
                                <li><a href="#">Resevation</a></li>
                                <li><a href="./officer_acc.php">Officer Accounts</a></li>
                            </ul>

                            <!---------Content------->
                            <div class="content">
                                <h3>Packages</h3>
                                <p>Details about Packages can be add, update or view.</p>
                                <!-------Error Message-------->
                                <div id="error_massege"><?php echo $msg ?></div>
                                <br>
                            </div>

                            <div class="container">
                                <ul class="nav nav-pills">
                                    <li class="active"><a data-toggle="pill" href="#view">View Details</a></li>
                                    <li><a data-toggle="pill" href="#update">Update</a></li>
                                    <li><a data-toggle="pill" href="#add_new">Add New</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="view" class="tab-pane fade in active">
                                        <h5>Current Package Details</h5>
                                        <div class="col-sm-5">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Package ID</th>
                                                        <th>Details</th>
                                                        <th>Price per km</th>
                                                        <th>Price per day</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        include('DBCon.php');
                                                        $result = mysqli_query($con,"SELECT * FROM package");
                                                        while ($row = mysqli_fetch_array($result)){
                                                            echo '<tr>';
                                                            echo '<td>'.$row['package_id'].'</td>';
                                                            echo '<td>'.$row['detail'].'</td>';
                                                            echo '<td>'.$row['per_km'].'</td>';
                                                            echo '<td>'.$row['per_day'].'</td>';
                                                            echo '</tr>';
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="update" class="tab-pane fade">
                                        <h5>Update existing package details</h5>

                                        <form class="form-horizontal" role="form" method="post" action="updatepackages.php">
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="package-id">Package ID:</label>
                                                <div class="col-sm-1">
                                                    <select class="form-control" name="package-id">
                                                        <option> </option>
                                                        <?php
                                                            include('DBCon.php');
                                                            $result = mysqli_query($con,"SELECT package_id FROM package");
                                                            while ($row = mysqli_fetch_array($result)){
                                                                echo '<option>'.$row['package_id'].'</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="discription">Discription:</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" name="discription" placeholder="Discription">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="price-per-km">Price per km:</label>
                                                <div class="col-sm-1">
                                                    <input type="text" class="form-control" name="price-per-km" placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="price-per-day">Price per day:</label>
                                                <div class="col-sm-1">
                                                    <input type="text" class="form-control" name="price-per-day" placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-default">Submit</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                    <div id="add_new" class="tab-pane fade">
                                        <h5>Add new package details</h5>
                                        <form class="form-horizontal" role="form" method="post" action="addpackages.php">
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="package-id">Device ID:</label>
                                                <div class="col-sm-1">
                                                    <input type="text" class="form-control" name="package-id" placeholder="ID">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="discription">Description:</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" name="discription" placeholder="Discription">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="price-per-km">Price per km:</label>
                                                <div class="col-sm-1">
                                                    <input type="text" class="form-control" name="price-per-km" placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="price-per-day">Price per day:</label>
                                                <div class="col-sm-1">
                                                    <input type="text" class="form-control" name="price-per-day" placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-default">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                        
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>
