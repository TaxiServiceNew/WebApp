<!DOCTYPE html>
<!-- Written by YOHAN-->
<html  manifest="cache.appcache">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>OneClick Taxi: Log In</title>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/login.css">
    </head>
    <body>
    <?php
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            
        }
        else {$msg="";}
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
                            <li><a href="#">Log In</a></li>
                        </ul>
                    </div>
                </div>
            </header>
            <div id="feature">
                <div id="feature-inner">
                    <h1>Log In</h1>
                </div>
            </div>
            <div id="content">
                <div id="content-inner">
                    <div id="content-up"></div>
                    <div id="content-middle">
                        <div id="sign-in">
                            <form class="form-horizontal" role="form" method="post" action="checklogin.php">
                                <!change action to suitable file>
                                <div class="form-group">
                                    <label class="control-label col-sm-1" for="name">Username:</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="name" placeholder="Enter usename">
                                        <!name here>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-1" for="pwd">Password:</label>
                                    <div class="col-sm-5">          
                                        <input type="password" class="form-control" name="pwd" placeholder="Enter password">
                                        <!password here>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">        
                                    <div class="col-sm-offset-1 col-sm-2">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                    <!----Error Message----->
                                    <div id="error_massege"><?php echo $msg; ?></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>