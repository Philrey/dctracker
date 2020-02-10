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
        
        //Load Geofences
        //$result = return_valuesWeb("*","places","",2);
    }
?>
<!DOCTYPE html>
<html>
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
  
     <!-- <link rel="stylesheet" href="../styles.css"> -->
        <script src="../scripts/myFunctions.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </header>

    <?php
        if(isset($_COOKIE['userId'])){
            echo '<body onload="initScripts2('.$_COOKIE['userId'].');">';
        }else{
            echo '<body onload="initScripts2(1);">';
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
        <!--Pages Left-->
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
                                <a class="nav-link" href="web_analytics.php">
                                    <i class="fas fa-fw fa-chart-pie"></i>Dashboard</a>
                                
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">
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
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->

<!-- ============================================================== -->
<!-- wrapper  -->
<div class="dashboard-wrapper">
  <div class="container-fluid  dashboard-content">
    <!-- pageheader  -->

    
       
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                            <h1 class="pageheader-title">Violation History</h1> 
                            </div>
                        </div>
                    </div>

                 <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Data Table</h5>
        <div class="roundedSquareTest top" style="background-color: #fff;margin:20px;margin-top:13px">
            <!--Search Bar-->
            <input type="text" id="toSearch" placeholder="Search plate number...">
        <button onclick="searchHistory(getAttValue('toSearch','value'),1,'','');" style="color: #2e2f39;">Search
            </button>

             <span style="color: #2e2f39;">Page:</span>
            <button id="btnPrev" onclick="turnPage(-1);" style="color: #5969ff"> < </button>
            <span id="pageNumber" style="color: #5969ff"> 1 </span>
            <button id="btnNext" onclick="turnPage(1);" style="color: #5969ff"> > </button>
        </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table  id="searchResult" class="table table-striped table-bordered first" >
                                        <thead>

                    <tr>
                        <th >Taxi Name</th>
                        <th >Plate Number</th>
                        <th >Type</th>
                        <th >Place of Violation</th>
                        <th >Date</th>
                        <th >Time</th>
                        <th >Profile</th>
                    </tr>
                    <tr>
                        <td class="wrapCol">
                            <small>Loading </small><img src="../images/loadingBars/loading_3bars.gif" alt="">
                        </td>
                        <td class="center">
                            <small>Loading </small><img src="../images/loadingBars/loading_3bars.gif" alt="">
                        </td>
                        <td class="center" style="width:80px;">
                            <small>Loading </small><img src="../images/loadingBars/loading_3bars.gif" alt="">
                        </td>
                        <td class="wrapCol">
                            <small>Loading </small><img src="../images/loadingBars/loading_3bars.gif" alt="">
                        </td>
                        <td class="center" style="width:100px;">
                            <small>Loading </small><img src="../images/loadingBars/loading_3bars.gif" alt="">
                        </td>
                        <td class="center" style="width:80px;">
                            <small>Loading </small><img src="../images/loadingBars/loading_3bars.gif" alt="">
                        </td>
                        <td class="center" style="width:60px;">
                            <small>Loading </small><img src="../images/loadingBars/loading_3bars.gif" alt="">
                        </td>
                    </tr>
                </table>
            </div>            
        </div>
        
                                           
                                            <foot>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end basic table  -->
                    <!-- ============================================================== -->
            </div>
     </div>
      <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    
       <!--  Title Bar
       <div class="titleBar">
           <table border="0" width="100%">
               <tr>
                   <td class="left">
                       <span>DC-TRACKER</span>        
                   </td>
                   <td class="right">
                       <form action="" method="post">
                           <button type="submit" name="logOut" value="TRUE">Log Out</button>
                       </form>        
                   </td>
               </tr>
           </table>
       </div>
       <br><br><br><br>
       
       Pages Left
       <div class="roundedSquareTest top">
           <a href="web_dashBoard.php">Dashboard</a>
           <br>
           <a href="web_analytics.php">Analytics</a>
           <br>
           <span>Violation History</span>
       </div>
       Violation History
       <div class="roundedSquareTest top" >
           Search Bar
           <input type="text" id="toSearch" placeholder="Search plate number...">
           <button onclick="searchHistory(getAttValue('toSearch','value'),1,'','');">Search</button>
       
           pagination
           <span>Page:</span>
           <button id="btnPrev" onclick="turnPage(-1);"> < </button>
           <span id="pageNumber"> 1 </span>
           <button id="btnNext" onclick="turnPage(1);"> > </button>
       
           <div class="overflowContents" style="width:1000px;height:400px;">
               <table  id="searchResult" style="width:100%;" class="">
                   <tr>
                       <th >Taxi Name</th>
                       <th >Plate #</th>
                       <th >Type</th>
                       <th >Place of Violation</th>
                       <th >Date</th>
                       <th >Time</th>
                       <th >Profile</th>
                   </tr>
                   <tr>
                       <td class="wrapCol">
                           <small>Loading </small><img src="../images/loadingBars/loading_3bars.gif" alt="">
                       </td>
                       <td class="center">
                           <small>Loading </small><img src="../images/loadingBars/loading_3bars.gif" alt="">
                       </td>
                       <td class="center" style="width:80px;">
                           <small>Loading </small><img src="../images/loadingBars/loading_3bars.gif" alt="">
                       </td>
                       <td class="wrapCol">
                           <small>Loading </small><img src="../images/loadingBars/loading_3bars.gif" alt="">
                       </td>
                       <td class="center" style="width:100px;">
                           <small>Loading </small><img src="../images/loadingBars/loading_3bars.gif" alt="">
                       </td>
                       <td class="center" style="width:80px;">
                           <small>Loading </small><img src="../images/loadingBars/loading_3bars.gif" alt="">
                       </td>
                       <td class="center" style="width:60px;">
                           <small>Loading </small><img src="../images/loadingBars/loading_3bars.gif" alt="">
                       </td>
                   </tr>
               </table>
           </div>            
       </div>
       
        -->
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