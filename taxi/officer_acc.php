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
        <title>OneClick Taxi: Officer Accounts</title>
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
                                <li><a href="./packages.php">Packages</a></li>
                                <li><a href="#">Resevation</a></li>
                                <li class="active"><a href="">Officer Accounts</a></li>
                            </ul>

                            <!---------Content------->
                            <div class="content">
                                <h3>Officer Accounts</h3>
                                <p>Details about officer accounts can be added and view.</p>
                                <!-------Error Message-------->
                                <div id="error_massege"><?php echo $msg ?></div>
                                <br>
                            </div>

                            <div class="container">
                                <ul class="nav nav-pills">
                                    <li class="active"><a data-toggle="pill" href="#add_new">Add New</a></li>
                                    <li><a data-toggle="pill" href="#update">Update</a></li>
                                    <li><a data-toggle="pill" href="#view">Officer Details</a></li>
                                    <li><a data-toggle="pill" href="#view_rank">Rank Details</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="add_new" class="tab-pane fade in active">
                                        <h5>Add new officer</h5>
                                        <form class="form-horizontal" role="form" method="post" action="add_officer_acc.php">
                                            <p>Basic Details</p>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="f_name">First Name:</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="f_name" placeholder="first name">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="l_name">Last Name:</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="l_name" placeholder="last name">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="o_nic">NIC:</label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" name="o_nic" placeholder="NIC number">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="address">Address:</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="address" placeholder="Address">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="tel_no">Telephone No:</label>
                                                <div class="col-sm-2">
                                                    <input type="tel" class="form-control" name="tel_no" placeholder="telephone">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="rank_id">Rank ID:</label>                                                
                                                <div class="col-sm-1">
                                                    <select class="form-control" name="rank_id">
                                                        <option> </option>
                                                        <?php
                                                        include('./DBCon.php');
                                                        $result = mysqli_query($con, "SELECT rank_id FROM officer_rank");
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            echo '<option>' . $row['rank_id'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <p>Login Details</p>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="login_name">Login Name:</label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" name="login_name" placeholder="Login Name">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="password">Password:</label>
                                                <div class="col-sm-3">
                                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="re_password">Retype Password:</label>
                                                <div class="col-sm-3">
                                                    <input type="password" class="form-control" name="re_password" placeholder="Password">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="pri_level">Privilage Level:</label>
                                                <div class="col-sm-1">
                                                    <input type="number" class="form-control" name="pri_level" placeholder="Level">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-default">Submit</button>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="admin_password">Enter Administrative Password:</label>
                                                <div class="col-sm-3">
                                                    <input type="password" class="form-control" name="admin_password" placeholder="Admin">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div id="update" class="tab-pane fade">
                                        <h5>Update current officer details</h5>
                                        <form class="form-horizontal" role="form" method="post" action="update_officer_acc.php">
                                            <p>Basic Details Changing</p>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="address">Address:</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="address" placeholder="Address">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="tel_no">Telephone No:</label>
                                                <div class="col-sm-2">
                                                    <input type="tel" class="form-control" name="tel_no" placeholder="telephone">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="rank_id">Rank ID:</label>                                                
                                                <div class="col-sm-1">
                                                    <select class="form-control" name="rank_id">
                                                        <option> </option>
                                                        <?php
                                                        include('DBCon.php');
                                                        $result = mysqli_query($con, "SELECT rank_id FROM officer_rank");
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            echo '<option>' . $row['rank_id'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <p>Login Details</p>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="login_name">Login Name:</label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" name="login_name" placeholder="Login Name">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="password">New Password:</label>
                                                <div class="col-sm-3">
                                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="re_password">Retype New Password:</label>
                                                <div class="col-sm-3">
                                                    <input type="password" class="form-control" name="re_password" placeholder="Password">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="pri_level">Privilage Level:</label>
                                                <div class="col-sm-1">
                                                    <input type="text" class="form-control" name="pri_level" placeholder="Level">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-default">Submit</button>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="admin_password">Enter Administrative Password:</label>
                                                <div class="col-sm-3">
                                                    <input type="password" class="form-control" name="admin_password" placeholder="Admin">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="old_usr_password">Enter Old User Password:</label>
                                                <div class="col-sm-3">
                                                    <input type="password" class="form-control" name="old_usr_password" placeholder="Old">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div id="view" class="tab-pane fade">
                                        <h5>Officer Details</h5>
                                        <div class="col-sm-5">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>First name</th>
                                                        <th>Last name</th>
                                                        <th>NIC</th>
                                                        <th>Address</th>
                                                        <th>Telephone</th>
                                                        <th>Rank</th>
                                                        <th>User Name</th>
                                                        <th>Privilage Level</th>                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    include('DBCon.php');
                                                    $result = mysqli_query($con, "SELECT * FROM officer_rank JOIN officer JOIN officer_login JOIN officer_tp WHERE officer.O_NIC=officer_login.O_NIC AND officer_rank.rank_id=officer.rank_id AND officer_tp.O_NIC=officer.O_NIC;");
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        echo '<tr>';
                                                        echo '<td>' . $row['first_name'] . '</td>';
                                                        echo '<td>' . $row['last_name'] . '</td>';
                                                        echo '<td>' . $row['O_NIC'] . '</td>';
                                                        echo '<td>' . $row['address'] . '</td>';
                                                        echo '<td>' . $row['telephone'] . '</td>';
                                                        echo '<td>' . $row['rank_name'] . '</td>';
                                                        echo '<td>' . $row['user_name'] . '</td>';
                                                        echo '<td>' . $row['priviledge'] . '</td>';
                                                        echo '</tr>';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="view_rank" class="tab-pane fade">
                                        <h5>Rank Details</h5>
                                        <div class="col-sm-5">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Rank ID</th>
                                                        <th>Rank</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    include('DBCon.php');
                                                    $result = mysqli_query($con, "SELECT * FROM officer_rank");
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        echo '<tr>';
                                                        echo '<td>' . $row['rank_name'] . '</td>';
                                                        echo '<td>' . $row['rank_id'] . '</td>';
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
