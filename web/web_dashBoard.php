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
        }else{
            //Load Geofences
            $result = return_valuesWeb("*","places","",2);
        }
        
    }
?>
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

        <script src="../scripts/myFunctions.js"></script>

        <!--Map Box SDK-->
        <script src='https://api.mapbox.com/mapbox-gl-js/v1.4.1/mapbox-gl.js'></script>
        <link href='https://api.mapbox.com/mapbox-gl-js/v1.4.1/mapbox-gl.css' rel='stylesheet'/>
        
    </header>
    <?php
        if(isset($_COOKIE['userId'])){
            echo '<body onload="initScripts('.$_COOKIE['userId'].');">';
        }else{
            echo '<body onload="initScripts(1);">';
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
                <a class="navbar-brand text-white" href="web_dashBoard.php">
                    <img src="../images/icons/DCTRACKER_LOGO.png" alt="" style="height: 30px;">
                    DC-TRACKER
                </a>
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
                                    <h5 class="mb-0 text-white nav-user-name">Administrator</h5>
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

    
        <table class="uielements">
            <tr>
              <td class="leftCard">
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
                               <a class="nav-link active" href="">
                                   <i class="fas fa-fw fa-map-marker-alt"></i>Home</a>
                               
                           </li>
                           <li class="nav-item">
                               <a class="nav-link" href="web_analytics.php">
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
      <!--   end left sidebar  -->

                  <!-- Pages Left -->
               <!--  <div class="roundedSquare" style="margin-top:100px;">
                  <span>Dashboard</span>
                  <br>
                   <a href="">Analytics</a>
                   <br>
                   <a href="">Violation History</a>
               </div> -->


              </td>
               <!-- Page center -->
                <td class="centerCard">
                   <!--  Map Container -->
                    <div id='map'>
                </td>
                <!-- End center sidebar -->

                <!-- Page right -->
                <td class="rightCard center top" >
                	<div class="nav-left-sidebar bg-white" style="width:300px;">
    
                   <!--  Time Date -->
                    <div class="roundedSquareTest top" style="margin-top:15px;vertical-align:middle;">
                        <span id="dateTime">
                            <img src="../images/loadingBars/loading_3bars.gif" alt="">
                        </span>
                    </div>
                    <hr>
                   <!--  Status Users -->
                    <div class="roundedSquareTest top" >
                        <table style="width: 100%; text-align:center;">
                            <tr>
                                <td class="left" style="color:#007eff;font-weight:bold;">STATUS</td>
                                <td></td>
                            </tr>
                            <?php
                                //Load if user logged in is CCTMO
                                if($_COOKIE['userId']==1){
                                    echo '<tr>
                                    <td class="left">TOTAL ALERTS</td>
                                    <td id="allViolationsToday"><img src="../images/loadingBars/loading_3bars.gif" alt=""></td>
                                </tr>';
                                }
                            ?>
                            <tr>
                                <td class="left">TOTAL TAXI WITH DEVICES</td>
                                <td>
                                    <span id="usersOnline">
                                        <img src="../images/loadingBars/loading_3bars.gif" alt="">
                                    </span>/
                                    <span id="totalUsers">
                                        <img src="../images/loadingBars/loading_3bars.gif" alt="">
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <hr>
                   <!--  Status Alerts -->
                    <div class="roundedSquareTest top" >
                        <?php
                            //Hide if LTFRB is logged in
                            if($_COOKIE['userId'] == 1){
                                echo '<table style="width: 100%;">';
                            }else if($_COOKIE['userId'] == 2){
                                echo '<table style="width: 100%;display:none;">';
                            }
                        ?>
                            <tr>
                                <td class="left" style="color:#007eff;font-weight:bold;">ALERTS</td>
                                <td class="center">TOTAL</td>
                            </tr>
                            <tr>
                                <td class="left">ILLEGAL PARKING AREAS</td>
                                <td class="center" id="parkingAreas"><img src="../images/loadingBars/loading_3bars.gif" alt=""></td>
                            </tr>
                            <tr>
                                <td class="left">ILLEGAL PARKING ALERTS</td>
                                <td class="center" id="parkingViolationsToday"><img src="../images/loadingBars/loading_3bars.gif" alt=""></td>
                            </tr>
                        </table>
                    </div>
                    <hr>
                   <!--  Status Notifications -->
                    <div class="roundedSquareTest top">
                        <span style="color:#007eff;font-weight:bold">LATEST ACTIVITY</span>
                        <br><br>
                        <div id="dashBoardLatestActivity" class="overflowContents" style="height: 300px; width:auto;">
                            <img src="../images/loadingBars/loading_3bars.gif" alt="" style="display:block; margin:auto;">
                        </div>
                       <!--  <div style="vertical-align:bottom;">
                            <button onclick="redirectPage('web_violationHistory.php');">Show All Notifications</button>
                        </div> -->
                    </div>
                  </div>
                </td>
                 <!-- End right sidebar -->
            </tr>
        </table>
    </div>
        <!--Load Map-->
        <script src="../scripts/loadBasicMap.js"></script>
        <!--Map functions-->
        <script>
            map.on('load',function(){
                map.addLayer({
                    id: "parkings",
                    type: "fill",
                    source: {
                    type: "geojson",
                    data: {
                        type: "Feature",
                        geometry: {
                        type: "MultiPolygon",
                        coordinates: 
                        [
                            <?php
                                if($_COOKIE['userId'] == 1){
                                    for($n=0;$n<sizeof($result);$n++){
                                        if($result[$n][2] == 1){
                                            echo '[['.convertToGeojson($result[$n][3]).']]';
                                            if($n != sizeof($result)-1){
                                                echo',';
                                            }
                                        }                                    
                                    }
                                }
                                
                            ?>
                        ]
                        }
                    }
                    },
                    layout: {},
                    paint: {
                    "fill-color": "#ff0000",
                    "fill-opacity": 0.5
                    }
                });
                map.addLayer({
                    id: "boundaries",
                    type: "fill",
                    source: {
                    type: "geojson",
                    data: {
                        type: "Feature",
                        geometry: {
                        type: "MultiPolygon",
                        coordinates: 
                        [
                            <?php
                                if($_COOKIE['userId'] == 2){
                                    for($n=0;$n<sizeof($result);$n++){
                                        if($result[$n][2] == 2){
                                            echo '[['.convertToGeojson($result[$n][3]).']]';
                                            if($n != sizeof($result)-1){
                                                echo',';
                                            }
                                        } 
                                    }
                                }
                            ?>
                        ]
                        }
                    }
                    },
                    layout: {},
                    paint: {
                    "fill-color": "#1100c9",
                    "fill-opacity": 0.5
                    }
                });                
            });
            function addMarker(latitude,longitude){
                try{
                    map.removeImage('custom-marker');
                    map.removeLayer('tempMarker');
                    map.removeSource('tempMarker');
                }catch(err){
                    /*Do nothing if there's no layers found */
                }
                map.loadImage("../images/car_marker_50x82.png", function(error, image) {
                    if (error) throw error;
                    map.addImage("custom-marker", image);
                    /* Style layer: A style layer ties together the source and image and specifies how they are displayed on the map. */
                    map.addLayer({
                        id: "tempMarker",
                        type: "symbol",
                        /* Source: A data source specifies the geographic coordinate where the image marker gets placed. */
                        source: {
                            type: "geojson",
                            data: {
                                type: 'FeatureCollection',
                                features: [
                                    {
                                        type: 'Feature',
                                        properties: {},
                                        geometry: {
                                            type: "Point",
                                            coordinates: [longitude,latitude] //lng,lat
                                        }
                                    }
                                ]
                            }
                        },
                        layout: {
                            "icon-image": "custom-marker",
                            "icon-offset": [0,(82/2)*-1]
                        }
                    });
                });
                map.flyTo({
                    center: [longitude,latitude],
                    zoom: 15
                });
            }
        </script>
        <br>
        
        
        
        

        




        
        
        <p>Load Test</p>

  </div>
 </div>
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