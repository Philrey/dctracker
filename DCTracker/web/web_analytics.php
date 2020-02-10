<?php
    include('functions.php');
    
    if(!isset($_COOKIE['loggedIn'])){
        echo '<script>';
        include('scripts/alert.js');
        echo '</script>';
        redirectPage('../index.php',0);
    }else{
      if(isset($_POST['logOut'])){
        //learSesstions();
        setcookie("loggedIn",1,time() - 3600);
        redirectPage("../index.php",0);
      }
    }
?>
<!DOCTYPE html>
<html>
    <header>
         <header><!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/styles.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
    <title>DC-Tracker</title> 
    
        <script src="../scripts/myFunctions.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script src="../charts/Chart.min.js"></script>
        <script src="../charts/utils.js"></script>
        <link rel="stylesheet" href="../charts/Chart.min.css">
    </header>

    <?php
        if(isset($_COOKIE['userId'])){
            echo '<body onload="initScripts3('.$_COOKIE['userId'].');">';
        }else{
            echo '<body onload="initScripts3(1);">';
        }
    ?>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper" >
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header" >
            <nav class="navbar navbar-expand-lg fixed-top" style="background-image: linear-gradient(to right, #FFD858 , #FFD854);">
                <a class="navbar-brand text-white" href="web_dashBoard.php">DC-TRACKER</a>
                <button class="navbar-toggler" data-toggle="collapse" data-target="navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                      <li class="nav-item"></li> 

                            <!-- Navbar notification -->
                        <li class="nav-item dropdown notification">
                            <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-bell"></i>
                                
                            <!--  Red dot notification indicator -->
                             <span id="newNotif" class="indicator"></span></a>

                            <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                                <li>
                                    <div class="notification-title"> Notification</div>
                                    <div class="notification-list">
                                        <br>
                                        <div id="dashBoardNotification" class="overflowContents">
                                            <img src="../images/loadingBars/loading_3bars.gif" alt="" style="display:block; margin: auto;">
                                        </div>
                                                </div>
                                </li>
                                <li>
                                    <div class="list-footer"> <a href="web_violationHistory.php">View all notifications</a></div>
                                </li>
                            </ul>
                        </li>
                           <!-- Navbar logout -->
                         <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/cttmo.jpg" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <?php
                                      if(isset($_COOKIE['userId'])){
                                          if($_COOKIE['userId'] == 1){
                                              echo '<h5 class="mb-0 text-white nav-user-name">CTTMO</h5>';    
                                          }else{
                                              echo '<h5 class="mb-0 text-white nav-user-name">LTFRB</h5>';
                                          }                                            
                                      }else{
                                          echo '<h5 class="mb-0 text-white nav-user-name">CTTMO</h5>';
                                      }
                                    ?>
                                    <span class="status"></span><span class="ml-2">Administrator</span>
                                </div>

                    <form action="../index.php" method="post">
                        <button type="submit" name="logOut" value="TRUE" class="dropdown-item">
                                <i  class="fas fa-power-off mr-2" ></i>Logout</button>
                    </form> 
                                      
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== --> 
        <!-- left sidebar -->
        <div class="nav-left-sidebar bg-white">
            <div class="menu-list bg-white">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link active" href="web_dashBoard.php">
                                    <i class="fas fa-fw fa-map-marker-alt"></i>Home</a>
                                
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">
                                    <i class="fas fa-fw fa-chart-pie"></i>Dashboard</a>
                                
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="web_violationHistory.php">
                                    <i class="fas fa-fw fa-table"></i>Violation History</a>
                                
                            </li>
                           

                              <br>
                            <br>
                             <br>
                            <br>
                             <br>
                            <br>
                             <br>
                            <br>
                             <br>
                              <br>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="#">Help</a>
        

                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">About DC-Tracker</a>
                               

                            </li>
                            
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- end left sidebar -->

         <div class="dashboard-wrapper">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                 <h1 class="pageheader-title">Dashboard</h1>
                            </div>
                        </div>
                    </div>


          <!-- Content Row -->
          <div class="row">

            <!-- Annual Reports -->
            <div class="col-xl-3 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">ANNUAL REPORTS</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <span id="annualReports">
            <small>Loading </small><img src="../images/loadingBars/loading_3bars.gif" alt="">
                        </span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Monthly Reports -->
            <div class="col-xl-3 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">MONTHLY REPORTS</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <span id="monthlyReports">
            <small>Loading </small><img src="../images/loadingBars/loading_3bars.gif" alt="">
                        </span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Weekly Reports -->
            <div class="col-xl-3 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">WEEKLY REPORTS</div>
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                              <span id="weeklyReports">
            <small>Loading </small><img src="../images/loadingBars/loading_3bars.gif" alt="">
                              </span>
                          </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Total Users -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Tracker Devices</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                          <span id="totalUsers">
            <small>Loading </small><img src="../images/loadingBars/loading_3bars.gif" alt="">
                          </span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-taxi fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        <!-- Pie Chart -->
        <div class="row">
            <div class="col-xl-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h5 class="m-0 font-weight-bold text-primary">Chart</h5>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    
                    <!-- Annual Pie Chart -->
                    <div class="roundedSquareTest top">
                    <canvas id="myChartAnnual" width="300" height="300"></canvas>
                    </div>

               <!--  Monthly Pie Chart -->
               <div class="roundedSquareTest top">
                   <canvas id="myChartMonthly"  width="300" height="300"></canvas>
               </div>
             
                <!-- Weekly Pie Chart -->
               <div class="roundedSquareTest top">        
               <canvas id="myChartWeekly"  width="300" height="300"></canvas>
               </div>
                
                </div>
              </div>
            </div>
          </div>


        <!-- 
        Pages Left
        <div class="roundedSquareTest top" >
            <a href="web_dashBoard.php">Dashboard</a>
            <br>
            <span>Analytics</span>
            <br>
            <a href="web_violationHistory.php">Violation History</a> -->
            
       <!--  </div>
       Annual Reports
       <div class="roundedSquareTest top">
           <p>Annual Reports</p>
           <span id="annualReports">
               <small>Loading </small><img src="../images/loadingBars/loading_3bars.gif" alt="">
           </span>
       </div>
       Monthly Reports
       <div class="roundedSquareTest top">
           <p>Monthly Reports</p>
           <span id="monthlyReports">
               <small>Loading </small><img src="../images/loadingBars/loading_3bars.gif" alt="">
           </span>
       </div>
       Weekly Reports
       <div class="roundedSquareTest top">
           <p>Weekly Reports</p>   
           <span id="weeklyReports">
               <small>Loading </small><img src="../images/loadingBars/loading_3bars.gif" alt="">
           </span>
       </div>
       Total Users
       <div class="roundedSquareTest top">
           <p>Total Tracker Devices</p>
           <span id="totalUsers">
               <small>Loading </small><img src="../images/loadingBars/loading_3bars.gif" alt="">
           </span>
       </div> -->
        <!--Annual Table Chart-->
        <!-- <div class="roundedSquareTest top">
            <canvas id="myChartAnnual" width="400" height="400"></canvas>
        </div>
        Annual Table Chart
        <div class="roundedSquareTest top">
            <canvas id="myChartMonthly" width="400" height="400"></canvas>
        </div>
        Annual Table Chart
        <div class="roundedSquareTest top">
            <canvas id="myChartWeekly" width="400" height="400"></canvas>
        </div> -->
        
         <!-- ============================================================== -->
       <!-- end basic table  -->
        <!-- ============================================================== -->
    </div>
 </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
        <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- bootstap bundle js -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- slimscroll js -->
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
    <script src="assets/libs/js/main-js.js"></script>
    <!-- chart chartist js -->
    <script src="assets/vendor/charts/chartist-bundle/chartist.min.js"></script>
    <!-- sparkline js -->
    <script src="assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
    <!-- morris js -->
    <script src="assets/vendor/charts/morris-bundle/raphael.min.js"></script>
    <script src="assets/vendor/charts/morris-bundle/morris.js"></script>
    <!-- chart c3 js -->
    <script src="assets/vendor/charts/c3charts/c3.min.js"></script>
    <script src="assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
    <script src="assets/vendor/charts/c3charts/C3chartjs.js"></script>
    <script src="assets/libs/js/dashboard-ecommerce.js"></script> 
    </body>
</html>