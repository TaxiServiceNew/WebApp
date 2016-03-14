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
                    <h1>User : <?php echo $uname ?></h1>
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
                                <li class="active"><a href="">Emb. Devices</a></li>
                                <li><a href="./drivers.php">Drivers</a></li>
                                <li><a href="./vehicles.php">Vehicles</a></li>
                                <li><a href="./packages.php">Packages</a></li>
                                <li><a href="#">Resevation</a></li>
                                <li><a href="./officer_acc.php">Officer Accounts</a></li>
                            </ul>

                            <!---------Content------->
                            <div class="content">
                                <h3>Embeded Devices</h3>
                                <p>Details about Embeded Devices can be add, update or view.</p>
                                <!-------Error Message-------->
                                <div id="error_massege"><?php echo $msg ?></div>
                                <br>
                            </div>

                            <div class="container">
                                <ul class="nav nav-pills">
                                    <li class="active"><a data-toggle="pill" href="#add_new">Add New</a></li>
                                    <li><a data-toggle="pill" href="#update">Update</a></li>
                                    <li><a data-toggle="pill" href="#view">View Details</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="add_new" class="tab-pane fade in active">
                                        <h5>Add new device details</h5>
                                        <form class="form-horizontal" role="form" method="post" action="add_emb_device.php">
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="device-id">Device ID:</label>
                                                <div class="col-sm-1">
                                                    <input type="text" class="form-control" name="device_id" placeholder="ID">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="discription">Description:</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" name="discription" placeholder="Discription">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="onservice"  value="true" unchecked>On Service</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="bought_date">Bought Date:</label>
                                                <div class="col-sm-4">
                                                    <input type="date" class="form-control" name="bought_date" placeholder="Baught Date">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="end_date">End Date:</label>
                                                <div class="col-sm-4">
                                                    <input type="date" class="form-control" name="end_date" placeholder="End Date">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-default">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div id="update" class="tab-pane fade">
                                        <h5>Update existing device details</h5>

                                        <form class="form-horizontal" role="form" method="post" action="update_emb_device.php">
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="device-id">Device ID:</label>
                                                <div class="col-sm-1">
                                                    <select class="form-control" id="sel1">
                                                        <option> </option>
                                                        <?php
                                                            include('DBCon.php');
                                                            $result = mysqli_query($con,"SELECT device_id FROM device");
                                                            while ($row = mysqli_fetch_array($result)){
                                                                echo '<option>'.$row['device_id'].'</option>';
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
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <div class="checkbox">
                                                        <label><input type="checkbox"  name="onservice">On Service</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="bought_date">Bought Date:</label>
                                                <div class="col-sm-4">
                                                    <input type="date" class="form-control" name="bought_date" placeholder="Baught Date">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="end_date">End Date:</label>
                                                <div class="col-sm-4">
                                                    <input type="date" class="form-control" name="end_date" placeholder="End Date">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
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
                                                        <th>Device ID</th>
                                                        <th>Description</th>
                                                        <th>On service</th>
                                                        <th>Bought Date</th>
                                                        <th>End Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        include('DBCon.php');
                                                        $result = mysqli_query($con,"SELECT * FROM device");
                                                        while ($row = mysqli_fetch_array($result)){
                                                            echo '<tr>';
                                                            echo '<td>'.$row['device_id'].'</td>';
                                                            echo '<td>'.$row['description'].'</td>';
                                                            echo '<td>'.$row['on_service'].'</td>';
                                                            echo '<td>'.$row['bought_date'].'</td>';
                                                            echo '<td>'.$row['end_date'].'</td>';
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
