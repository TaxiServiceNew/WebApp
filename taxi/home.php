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
        <link rel="stylesheet" type="text/css" href="css/basic.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </head>
    <body>


        <?php
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
        } else {
            $msg = "Something Wrong!!!!.No username passed from login page";
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
                            <li><a href="#">About</a></li>
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
                                <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
                                <li><a href="./emb_devices.php">Emb. Devices</a></li>
                                <li><a href="./drivers.php">Drivers</a></li>
                                <li><a href="./vehicles.php">Vehicles</a></li>
                                <li><a href="./packages.php">Packages</a></li>
                                <li><a href="#">Resevation</a></li>
                                <li><a href="./officer_acc.php">Officer Accounts</a></li>
                            </ul>

                            <!---------Menu Content------->
                            <div class="tab-content">
                                <div id="home" class="tab-pane fade in active">
                                    <h3>HOME</h3>
                                    <p>Welcome to OneClic Taxi Service officer home page</p>
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