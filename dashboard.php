<?php include ('include/config.php'); 
session_start();
if(!isset($_SESSION['email']))
{
    session_destroy();
    
    echo "<script>window.location='index.php';</script>";
    exit;
     
}
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard | Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>


    <!-- Left Panel -->

    <?php include ('include/sidemenu.php'); ?>

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <?php include ('include/header.php'); ?>
        <!-- Header-->

        <div class="content mt-3">            
            <?php
            $get_contactus = mysqli_query($conn,"select * from contactus");
            $contactus = mysqli_num_rows($get_contactus);
            ?>
            <div class="col-xs-6 col-sm-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="clearfix">
                            <i class="fa fa-list bg-flat-color-5 p-3 font-2xl mr-3 float-left text-light"></i>
                            <div class="h5 text-secondary mb-0 mt-1"><?php echo $contactus; ?></div>
                            <div class="text-muted text-uppercase font-weight-bold font-xs small">Contact Us</div>
                        </div>
                        <div class="b-b-1 pt-3"></div>
                        <hr>
                        <div class="more-info pt-2" style="margin-bottom:-10px;">
                            <a class="font-weight-bold font-xs btn-block text-muted small" href="contact.php">View More <i class="fa fa-angle-right float-right font-lg"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            $get_community = mysqli_query($conn,"select * from community");
            $community = mysqli_num_rows($get_community);
            ?>
            <div class="col-xs-6 col-sm-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="clearfix">
                            <i class="fa fa-list bg-info p-3 font-2xl mr-3 float-left text-light"></i>
                            <div class="h5 text-secondary mb-0 mt-1"><?php echo $community; ?></div>
                            <div class="text-muted text-uppercase font-weight-bold font-xs small">Community</div>
                        </div>
                        <div class="b-b-1 pt-3"></div>
                        <hr>
                        <div class="more-info pt-2" style="margin-bottom:-10px;">
                            <a class="font-weight-bold font-xs btn-block text-muted small" href="communitylist.php">View More <i class="fa fa-angle-right float-right font-lg"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            $get_ksmic_user = mysqli_query($conn,"select * from ksmic_user");
            $ksmic_user = mysqli_num_rows($get_ksmic_user);
            ?>
            <div class="col-xs-6 col-sm-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="clearfix">
                            <i class="fa fa-user bg-info p-3 font-2xl mr-3 float-left text-light"></i>
                            <div class="h5 text-secondary mb-0 mt-1"><?php echo $ksmic_user; ?></div>
                            <div class="text-muted text-uppercase font-weight-bold font-xs small">User</div>
                        </div>
                        <div class="b-b-1 pt-3"></div>
                        <hr>
                        <div class="more-info pt-2" style="margin-bottom:-10px;">
                            <a class="font-weight-bold font-xs btn-block text-muted small" href="userlist.php">View More <i class="fa fa-angle-right float-right font-lg"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $get_announcement = mysqli_query($conn,"select * from announcement");
            $ksmic_announcement = mysqli_num_rows($get_announcement);
            ?>
            <div class="col-xs-6 col-sm-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="clearfix">
                            <i class="fa fa-bell bg-danger p-3 font-2xl mr-3 float-left text-light"></i>
                            <div class="h5 text-secondary mb-0 mt-1"><?php echo $ksmic_announcement; ?></div>
                            <div class="text-muted text-uppercase font-weight-bold font-xs small">Announcement</div>
                        </div>
                        <div class="b-b-1 pt-3"></div>
                        <hr>
                        <div class="more-info pt-2" style="margin-bottom:-10px;">
                            <a class="font-weight-bold font-xs btn-block text-muted small" href="announcement.php">View More <i class="fa fa-angle-right float-right font-lg"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $get_ksmic_event = mysqli_query($conn,"select * from ksmic_event");
            $ksmic_ksmic_event = mysqli_num_rows($get_ksmic_event);
            ?>
            <div class="col-xs-6 col-sm-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="clearfix">
                            <i class="fa fa-cog bg-flat-color-5 p-3 font-2xl mr-3 float-left text-light"></i>
                            <div class="h5 text-secondary mb-0 mt-1"><?php echo $ksmic_ksmic_event; ?></div>
                            <div class="text-muted text-uppercase font-weight-bold font-xs small">Event</div>
                        </div>
                        <div class="b-b-1 pt-3"></div>
                        <hr>
                        <div class="more-info pt-2" style="margin-bottom:-10px;">
                            <a class="font-weight-bold font-xs btn-block text-muted small" href="eventlist.php">View More <i class="fa fa-angle-right float-right font-lg"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $get_ksmic_post = mysqli_query($conn,"select * from ksmic_post");
            $ksmic_ksmic_post = mysqli_num_rows($get_ksmic_post);
            ?>
            <div class="col-xs-6 col-sm-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="clearfix">
                            <i class="fa fa-user bg-info p-3 font-2xl mr-3 float-left text-light"></i>
                            <div class="h5 text-secondary mb-0 mt-1"><?php echo $ksmic_ksmic_post; ?></div>
                            <div class="text-muted text-uppercase font-weight-bold font-xs small">Post</div>
                        </div>
                        <div class="b-b-1 pt-3"></div>
                        <hr>
                        <div class="more-info pt-2" style="margin-bottom:-10px;">
                            <a class="font-weight-bold font-xs btn-block text-muted small" href="postlist.php">View More <i class="fa fa-angle-right float-right font-lg"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="clearfix">
                            <i class="fa fa-user bg-info p-3 font-2xl mr-3 float-left text-light"></i>
                            <div class="h5 text-secondary mb-0 mt-1"><?php echo $ksmic_ksmic_post; ?></div>
                            <div class="text-muted text-uppercase font-weight-bold font-xs small">Pray List</div>
                        </div>
                        <div class="b-b-1 pt-3"></div>
                        <hr>
                        <div class="more-info pt-2" style="margin-bottom:-10px;">
                            <a class="font-weight-bold font-xs btn-block text-muted small" href="praylisting.php">View More <i class="fa fa-angle-right float-right font-lg"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="clearfix">
                            <i class="fa fa-user bg-info p-3 font-2xl mr-3 float-left text-light"></i>
                            <div class="h5 text-secondary mb-0 mt-1"><?php echo $ksmic_ksmic_post; ?></div>
                            <div class="text-muted text-uppercase font-weight-bold font-xs small">Daily Prayer</div>
                        </div>
                        <div class="b-b-1 pt-3"></div>
                        <hr>
                        <div class="more-info pt-2" style="margin-bottom:-10px;">
                            <a class="font-weight-bold font-xs btn-block text-muted small" href="dailyprayer.php">View More <i class="fa fa-angle-right float-right font-lg"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="assets/js/lib/chart-js/Chart.bundle.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>

</body>
</html>